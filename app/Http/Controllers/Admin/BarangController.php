<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBarangRequest;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BarangController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barangs = Barang::with(['media'])->get();

        return view('admin.barangs.index', compact('barangs'));
    }

    public function create()
    {
        abort_if(Gate::denies('barang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.barangs.create');
    }

    public function store(StoreBarangRequest $request)
    {
        $barang = Barang::create($request->all());

        foreach ($request->input('gambar_barang', []) as $file) {
            $barang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gambar_barang');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $barang->id]);
        }

        return redirect()->route('admin.barangs.index');
    }

    public function edit(Barang $barang)
    {
        abort_if(Gate::denies('barang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.barangs.edit', compact('barang'));
    }

    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());

        if (count($barang->gambar_barang) > 0) {
            foreach ($barang->gambar_barang as $media) {
                if (!in_array($media->file_name, $request->input('gambar_barang', []))) {
                    $media->delete();
                }
            }
        }
        $media = $barang->gambar_barang->pluck('file_name')->toArray();
        foreach ($request->input('gambar_barang', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $barang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gambar_barang');
            }
        }

        return redirect()->route('admin.barangs.index');
    }

    public function show(Barang $barang)
    {
        abort_if(Gate::denies('barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.barangs.show', compact('barang'));
    }

    public function destroy(Barang $barang)
    {
        abort_if(Gate::denies('barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barang->delete();

        return back();
    }

    public function massDestroy(MassDestroyBarangRequest $request)
    {
        Barang::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('barang_create') && Gate::denies('barang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Barang();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

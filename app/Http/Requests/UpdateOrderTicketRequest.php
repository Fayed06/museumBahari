<?php

namespace App\Http\Requests;

use App\Models\OrderTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_ticket_edit');
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
            ],
            'jumlah_tiket' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tanggal_pemesanan' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'bukti_pembayaran' => [
                'required',
            ],
        ];
    }
}

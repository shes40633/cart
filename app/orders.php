<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $order_no
 * @property string $recipient_name
 * @property string $recipient_phone
 * @property string $recipient_cellphone
 * @property string $recipient_adress
 * @property string $recipient_email
 * @property string $invoice
 * @property string $input_time
 * @property string $status
 * @property string $recipient_remark
 * @property string $created_at
 * @property string $updated_at
 * @property Orderitem[] $orderitems
 */
class orders extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_no', 'recipient_name', 'recipient_phone', 'recipient_cellphone', 'recipient_adress', 'recipient_email','totalprice', 'invoice', 'input_time', 'status', 'recipient_remark', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderitems()
    {
        return $this->hasMany('App\Orderitems','order_id');
    }
}

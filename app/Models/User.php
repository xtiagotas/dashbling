<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateInterval;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'name',
        'email',
        'password',
        'address',
        'number',
        'neighborhood',
        'zipcode',
        'city',
        'state'
    ];

    public function isPeriodTest()
    {
        $tempoConta = (new DateTime())->diff(new DateTime($this->created_at))->days;
        return $tempoConta <= 14;
    }

    public function hasSubscription()
    {
        try {
            $assinatura = DB::table('subscriptions')->where('user_id', $this->id)->where('stripe_status', '<>', 'canceled')->first();

            if ($assinatura) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }

        return false;
    }

    public function  hasSubscriptionValid()
    {
        try {
            $assinatura = DB::table('subscriptions')->where('user_id', $this->id)->where('stripe_status', 'active')->first();

            if ($assinatura) {
                return true;
            }
        } catch (Exception $e) {
        }

        return false;
    }

    public function bling_token()
    {
        return $this->hasOne(BlingToken::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function situacoes()
    {
        return $this->hasMany(Situacao::class);
    }

    public function clientes()
    {
        return $this->hasMany(Contato::class);
    }

    public function vendedores()
    {
        return $this->hasMany(Vendedor::class);
    }

    public function lojas()
    {
        return $this->hasMany(Loja::class);
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class);
    }

    public function estoques()
    {
        return $this->hasMany(Estoque::class);
    }

    public function logisticas()
    {
        return $this->hasMany(Estoque::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

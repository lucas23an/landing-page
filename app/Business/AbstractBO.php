<?php

namespace App\Business;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

abstract class AbstractBO
{
    /**
     * Inicia uma transação
     */
    protected function beginTransaction()
    {
        DB::beginTransaction();
    }

    /**
     * Conclui uma  transação
     */
    protected function commit()
    {
        DB::commit();
    }

    /**
     * Cancela quaisquer alterações de banco de dados feitas durante a transação atual.
     */
    protected function rollback()
    {
        DB::rollBack();
    }

    /**
     * Converte a data para padrão 'Y-m-d'
     * 
     * @param $date
     * @return string
     */
    protected function formatDateFromEn($date)
    {
        if (isset($date)){
            $birthFormated = Carbon::createFromFormat('d/m/Y', $date);
            $date =  $birthFormated->format('Y-m-d');
        }

        return $date;
    }

    /**
     * Converte a data para o padrão 'd/m/Y'.
     * 
     * @param $date
     * @return string
     */
    protected function formatDateFromBr($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}
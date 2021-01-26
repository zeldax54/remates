<?php 

class ToroHelper
{

    public function getOferInfo($lote)
    {
        $info = '';
        foreach($lote->getToros() as $toro)
        {
            $ofertaActual = $toro->getOfertaActual();
            $info.=$toro->getName();
            $info.= $ofertaActual > 0 ? $ofertaActual:'-';
            $info.='|';
           
        }
        return $info;
    }

}
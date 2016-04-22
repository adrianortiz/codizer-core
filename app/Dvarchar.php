<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Dvarchar
 *
 * @mixin \Eloquent
 */
class Dvarchar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dvarchars';

    // protected $fillable = ['dtitle', 'content', 'form_id', 'input_id', 'val_text', 'val_textx', 'val_texty', 'val_num', 'val_numx', 'val_numy'];
    protected $fillable = ['dtitle', 'content', 'form_id', 'input_id', 'row_id', 'type_validation'];


    /**
     * Generate new row to new store data
     *
     * @param $idForm
     * @return int
     */
    static function getNewRowId($idForm)
    {
        $newRowId = 1;
        $rowId = \DB::table('dvarchars')
            ->where('form_id',$idForm)
            ->max('row_id');

        if ( !($rowId == 0 || empty($rowId) ))
            $newRowId = $rowId + 1;

        return $newRowId;
    }

    /**
     * Valida que el valor sea correcto
     * ['val_text', 'val_text_num', 'val_num', 'val_double', 'val_date']
     *
     * @param $typeValidation
     * @param $val_content
     * @return int
     */
    static function changeValToTypeValidation( $typeValidation , $val_content)
    {

        $val_content = ucwords($val_content);
        $val_content = ucwords(strtolower($val_content));

        if($typeValidation == 'val_text')
            return (string) $val_content;

        if($typeValidation == 'val_num')
            return (int) $val_content;

        if($typeValidation == 'val_double')
            return (double) $val_content;

        return $val_content;
    }

    /**
     * Store Data from Form of Collection
     *
     * @param $request
     * @param $id
     * @param $typeValidation
     * @param $newRowId
     */
    static function storeData( $request, $idForm, $typeValidation, $newRowId )
    {
        // Obtener datos
        $inputsID  = $request->input($typeValidation.'x');
        $inputsNom = $request->input($typeValidation.'y');

        $control = 0;

        // Alamacenar datos
        foreach ($request->input( $typeValidation ) as $val_content)
        {
            \DB::table('dvarchars')->insert([
                'dtitle'            => $inputsNom[$control],
                'content'           => Dvarchar::changeValToTypeValidation( $typeValidation , $val_content),
                'form_id'           => $idForm,
                'input_id'          => $inputsID[$control],
                'row_id'            => $newRowId,
                'type_validation'   => $typeValidation,
                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            $control++;
        }
    }


    /**
     * @param $datos
     * @return mixed
     */
    static function byVar( $datos )
    {
        $valRepetidos['categories'] = array();
        $series['data'] = array();
        foreach( array_count_values( Dvarchar::arrayDatosNum($datos) )  as $key => $value)
        {
            $valRepetidos['categories'][]   = (float) $key;
            $series['data'][]               = (float) $value;
        }

        $collectionName = Form::select('name')->where('id', $datos[0]->form_id)->get();

        $array[0] = $valRepetidos;
        $array[1] = $collectionName[0]->name;
        $array[2] = $series;
        $array[3] = $datos[0]->dtitle;

        $array[20] = Dvarchar::media( $datos );
        $array[21] = Dvarchar::mediana($datos);
        $array[22] = Dvarchar::moda($datos);

        $array[7] = 'byVar';

        return $array;
    }


    /**
     * @param $datos
     * @return mixed
     */
    static function tendenciaCetral( $datos )
    {
        $array[4] = Dvarchar::media( $datos );
        $array[5] = Dvarchar::mediana($datos);
        $array[6] = Dvarchar::moda($datos);

        $array[7] = 'Tendencia central';

        return $array;
    }


    /**
     * @param $datos
     * @param $groups
     * @return mixed
     */
    static function medidasDispersion( $datos, $groups)
    {
        $array[1] = Dvarchar::desvm( $datos, $groups);
        $array[2] = Dvarchar::varianza( $datos, $groups);
        $array[3] = Dvarchar::desves( $datos, $groups);

        $array[7] = 'Medidas de dispersión';

        return $array;
    }

    /**
     * @param $datos
     * @param $groups
     * @return mixed
     */
    static function medidasPosicion($datos, $groups)
    {
        $array[1] = Dvarchar::deciles( $datos, $groups);
        $array[2] = Dvarchar::percentiles( $datos, $groups);
        $array[3] = Dvarchar::cuartiles( $datos, $groups);

        $array[7] = 'Medidas de Posición';

        return $array;
    }


    static function medidasDeformacion($datos, $groups)
    {
        $array[1] = Dvarchar::sesgomo( $datos, $groups);
        $array[2] = Dvarchar::sesgomediana( $datos, $groups);
        $array[3] = Dvarchar::sesgoper( $datos, $groups);
        $array[4] = Dvarchar::sesgocuar( $datos, $groups);
        $array[5] = Dvarchar::sesgoa( $datos, $groups);

        $array[6] = Dvarchar::mo( $datos, $groups);
        $array[10] = Dvarchar::curtosisQ( $datos, $groups);
        $array[8] = Dvarchar::curtosis( $datos, $groups);
        $array[9] = Dvarchar::curtosisa( $datos, $groups);

        $array[7] = 'Medidas de Deformación';

        return $array;
    }


    /**
     * @param $id
     * @return mixed
     */
    static function getCollectionName($id){
        $collectionName = Form::select('name')->where('id', $id)->get();
        return $collectionName[0]->name;
    }

    /**
     * @param $datos
     * @param $group
     * @return mixed
     */
    static function byAutoIntervalHistograma( $datos, $group )
    {
        $intervalo = array();
        for($i = 0; $i < $group; $i++){
            $intervalo[] = Dvarchar::f_group($datos, $group)[0][$i] . " - " . Dvarchar::f_group($datos, $group)[1][$i];
        }

        $array[1] = Dvarchar::getCollectionName( $datos[0]->form_id );
        $array[3] = $datos[0]->dtitle; // Name columna

        $array[4] = $intervalo;
        $array[5] = Dvarchar::densidad($datos, $group);

        $array[20] = Dvarchar::media( $datos );
        $array[21] = Dvarchar::mediana($datos);
        $array[22] = Dvarchar::moda($datos);

        return $array;
    }

    /**
     * @param $datos
     * @param $group
     * @return mixed
     */
    static function byAutoIntervalOjiva( $datos, $group )
    {
        $intervalo = array();
        for($i = 0; $i < $group; $i++){
            $intervalo[] = Dvarchar::f_group($datos, $group)[0][$i] . " - " . Dvarchar::f_group($datos, $group)[1][$i];
        }

        $collectionName = Form::select('name')->where('id', $datos[0]->form_id)->get();

        $array[1] = $collectionName[0]->name;
        $array[3] = $datos[0]->dtitle; // Name columna

        $array[4] = $intervalo;
        $array[6] = Dvarchar::freqacum($datos, $group);

        $array[20] = Dvarchar::media( $datos );
        $array[21] = Dvarchar::mediana($datos);
        $array[22] = Dvarchar::moda($datos);

        return $array;
    }

    /**
     * === PENDIENTE ===
     *
     * @param $datos
     * @param $group
     * @return mixed
     */
    static function byAutoIntervalDispersion( $arrayDispOne, $arrayDispTwo, $group )
    {
        $intervalo = array();
        $xy = Dvarchar::twocolumns($arrayDispOne, $arrayDispTwo, $group );
        for($i = 0; $i < $group; $i++){
            $intervalo[] = $xy[0][0][$i] . " - " . $xy[0][1][$i];
        }

        //$collectionName = Form::select('name')->where('id', $datos[0]->form_id)->get();

        // $array[1] = $collectionName[0]->name;
        // $array[3] = $datos[0]->dtitle; // Name columna

        $array[4] = $intervalo;
        $array[8] = $xy[1];
        $array[9] = Dvarchar::minimoscuadrados($arrayDispOne, $arrayDispTwo, $group);

        return $array;
    }

    /**
     * Obtener datos y ordenarlos de menor a mayor
     * @param $datos
     * @return array
     */
    static function arrayDatosNum( $datos )
    {
        $array = array();

        foreach ($datos as $numerico) {
            $array[] = $numerico->content;
        }

        /**
         * Ordenar de menor a mayor
         */
        sort($array);
        return $array;

    }
    /**
     * @param $datos
     * @return float
     */
    static function media($datos)
    {
        return array_sum( Dvarchar::arrayDatosNum($datos) ) / count( Dvarchar::arrayDatosNum($datos) );
    }

    /**
     * @param $datos
     * @return float
     */
    static function mediana($datos)
    {
        $array = Dvarchar::arrayDatosNum($datos);
        sort($array);

        $N = count($array);
        $div = $N / 2;

        if($N % 2 == 0){
            return ($array[$div - 1] + $array[$div]) / 2;
        }else{
            return $array[$div - 1];
        }
    }

    /**
     * @param $datos
     * @return mixed|string
     */
    static function moda($datos)
    {
        $moda = array_count_values(Dvarchar::arrayDatosNum($datos));

        if($moda==2){
           return "No hay moda";
        }else
        arsort($moda);
        return key($moda);
    }

    /**
     * @param $datos
     * @return array
     */
    static function order($datos)
    {
        $array = Dvarchar::arrayDatosNum($datos);
        $distinct = array_unique($array);
        sort($distinct);
        return $distinct;
    }

    /**
     * @param $datos
     * @return mixed
     */
    static function range($datos)
    {
        $order = Dvarchar::order($datos);
        return ($order[count($order) - 1] - $order[0]) + 1;
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function width($datos, $group)
    {
        return ceil(Dvarchar::range($datos) / $group);
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function f_group($datos, $group)
    {
        $f1 = null;
        for($i = 0; $i < count(Dvarchar::order($datos)); $i++){
            $pos = strpos(Dvarchar::order($datos)[$i],'.');
            if($pos !== false){
                $str = count(substr(Dvarchar::order($datos)[$i],$pos + 1));
                if($str == 1){
                    $f1 = Dvarchar::order($datos)[0] - 0.25;
                }else if($str == 2){
                    $f1 = Dvarchar::order($datos)[0] - 0.125;
                }else if($str == 3){
                    $f1 = Dvarchar::order($datos)[0] - 0.0625;
                }
            }else {
                $f1 = Dvarchar::order($datos)[0] - 0.5;
            }
        }

        $fi = array();
        $ff = array();

        for($i = 0; $i < $group; $i++){
            $fi[$i] = $f1;
            $f1 = $f1 + Dvarchar::width($datos, $group);
            $ff[$i] = $f1;
        }
        return  $f_group = array(0 => $fi, 1 => $ff);
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function marca($datos, $group)
    {
        $f_group = Dvarchar::f_group($datos, $group);
        $marca = array();
        for($i = 0; $i < $group; $i++){
            $f_group[0][$i] = $f_group[0][$i] + (Dvarchar::width($datos, $group) / 2);
            $marca[] = $f_group[0][$i];
        }
        return $marca;
    }

    /**
     * @param $datos
     * @return int
     */
    static function limit($datos)
    {
        $limit = 0;
        for($i = 1; $i <= 15; $i++){
            if((Dvarchar::range($datos) / $i) >= 1){
                $limit = $i;
            }
        }
        return $limit;
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function freq($datos, $group)
    {
        $f_group = Dvarchar::f_group($datos, $group);
        $array = Dvarchar::arrayDatosNum($datos);
        sort($array);

        $count = array();
        $acum = 0;

        for($i = 0; $i < $group; $i++){
            for($j = 0; $j < count($array); $j++){
                if( $array[$j] > $f_group[0][$i] && $array[$j] < $f_group[1][$i] ){
                    $acum = $acum + 1;
                    $count[$i][] = $acum;
                }else{
                    $acum =0;
                    $count[$i][] = $acum;
                }
            }
        }

        $freq = array();

        for($i = 0; $i < $group; $i++){
            $freq[] = count(array_unique($count[$i])) - 1;
        }

        return $freq;
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function freqacum($datos, $group)
    {
        $freqacum[] = Dvarchar::freq($datos, $group)[0];
        for($i = 1; $i < $group; $i++){
            $freqacum[] = $freqacum[$i - 1] + Dvarchar::freq($datos, $group)[$i];
        }
        return $freqacum;
    }

    static function densidad($datos, $group){
        $densidad = array();
        for($i = 0; $i < $group; $i++){
            $densidad[] = Dvarchar::freq($datos, $group)[$i] / Dvarchar::width($datos, $group);
        }
        return $densidad;

    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function desvm($datos, $group)
    {
        $desvm = array();
        for($i = 0; $i < $group; $i++){
            $desvm[] = Dvarchar::marca($datos, $group)[$i] - Dvarchar::media($datos);
            $desvm[$i] = $desvm[$i] * Dvarchar::freq($datos, $group)[$i];
            $desvm[$i] = abs($desvm[$i]);
        }
        return array_sum($desvm) / array_sum(Dvarchar::freq($datos, $group));
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function desves($datos, $group)
    {
        $deses = array();
        for($i = 0; $i < $group; $i++){
            $deses[] = (Dvarchar::marca($datos, $group)[$i] - Dvarchar::media($datos))^2;
            $deses[$i] = $deses[$i] * Dvarchar::freq($datos, $group)[$i];
            $deses[$i] = abs($deses[$i]);
        }
        return sqrt( array_sum($deses) / array_sum(Dvarchar::freq($datos, $group)) );
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function varianza($datos, $group)
    {
        $varz = array();
        for($i = 0; $i < $group; $i++){
            $varz[] = (Dvarchar::marca($datos, $group)[$i] - Dvarchar::media($datos))^2;
            $varz[$i] = $varz[$i] * Dvarchar::freq($datos, $group)[$i];
        }
        return array_sum($varz) / array_sum(Dvarchar::freq($datos, $group));
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function mo($datos, $group)
    {
        $mo = array();
        for($i = 0; $i < 3; $i++){
            for($j = 0; $j < $group; $j++) {
                $sum[$i][] = pow(Dvarchar::marca($datos, $group)[$j] - Dvarchar::media($datos), $i + 2) *
                    Dvarchar::freq($datos, $group)[$j];
                $mo[$i] = array_sum($sum[$i]) / array_sum(Dvarchar::freq($datos, $group));
            }
        }
        return $mo;
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function sesgomo($datos, $group)
    {
        return (Dvarchar::media($datos) - Dvarchar::moda($datos)) / Dvarchar::desves($datos, $group);
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function sesgomediana($datos, $group)
    {
        return 3 * (Dvarchar::media($datos) - Dvarchar::mediana($datos)) / Dvarchar::desves($datos, $group);
    }

    static function sesgoper($datos, $group){
        $deciles = Dvarchar::deciles($datos, $group);
        return ( ($deciles[8] - $deciles[4]) - ($deciles[4] - $deciles[0]) ) / ($deciles[8] - $deciles[0]);
    }

    static function sesgocuar($datos, $group){
        $cuartiles = Dvarchar::cuartiles($datos, $group);
        return ( ($cuartiles[2] - $cuartiles[1]) - ($cuartiles[1] - $cuartiles[0]) ) / ($cuartiles[2] - $cuartiles[0]) ;
    }

    /**
     * @param $datos
     * @param $group
     * @return float
     */
    static function sesgoa($datos, $group)
    {
        return Dvarchar::mo($datos, $group)[1] / pow(Dvarchar::desves($datos, $group), 3);
    }

    static function curtosisQ($datos, $group){
        return 0.5 * (Dvarchar::cuartiles($datos, $group)[2] - Dvarchar::cuartiles($datos, $group)[0]);
    }

    static function curtosis($datos, $group){
        return Dvarchar::curtosisQ($datos, $group) /
        (Dvarchar::deciles($datos, $group)[8] - Dvarchar::deciles($datos, $group)[0]);
    }

    /**
     * @param $datos
     * @param $group
     * @return array|null|string
     */
    static function curtosisa($datos, $group)
    {
        $curtosisa=null;
        $res = Dvarchar::mo($datos, $group)[2] / pow(Dvarchar::desves($datos, $group), 4);
        if($res == 3){
            $curtosisa = 'Mesocurtica = ' . $res;
        }elseif($res > 3){
            $curtosisa = array('Leptocurtica = ' . $res);
        }elseif($res < 3){
            $curtosisa = array('Platicurtica = ' . $res);
        }
        return $curtosisa;
    }

    /**
     * @param $datos
     * @param $group
     * @return array
     */
    static function minimoscuadrados($arrayDispOne, $arrayDispTwo, $group)
    {
        $xy = Dvarchar::twocolumns($arrayDispOne, $arrayDispTwo, $group);

        $sumXY = array();
        $sumXsquare = array();

        for($i = 0; $i < $group; $i++){
            $sumXY[] = $xy[0][0][$i] * $xy[1][$i];
            $sumXsquare[] = pow($xy[0][0][$i], 2);
        }

        $dA = ( $group * array_sum($sumXsquare) ) - pow( array_sum($xy[0][0]), 2 );
        $da0 = ( array_sum($xy[1]) * array_sum($sumXsquare) ) -
            ( array_sum($sumXY) * array_sum($xy[0][0]) );
        $da1 = ( $group * array_sum($sumXY) ) -
            ( array_sum($xy[0][0]) * array_sum($xy[1]) );

        $minimoscuadrados = array();
        for($i = 0; $i < $group; $i++){
            $minimoscuadrados[] = ($da0 / $dA) + ( ($da1 / $dA) * $xy[0][0][$i] );
        }

        return $minimoscuadrados;
    }

    static function deciles($datos,$group){
        $frec = Dvarchar::freq($datos, $group);
        $frec_acum = Dvarchar::freqacum($datos, $group);
        $intervalos = Dvarchar::f_group($datos,$group);
        $ancho = Dvarchar::width($datos,$group);

        $deciles = array();
        for($i = 1; $i < 10; $i++) {
            foreach ($frec_acum as $key => $dato) {
                if ((array_sum($frec) * $i) / 10 <= $dato) {
                    if ($frec[$key] === 0) {
                        $deciles[] = $intervalos[0][$key];
                        break;
                    }else if ($key === 0) {
                        $deciles[] = $intervalos[0][$key] +
                            (((($i * array_sum($frec)) / 10) - $frec_acum[$key]) / $frec[$key]) * $ancho;
                        break;
                    } else if ($key > 0) {
                        $deciles[] = $intervalos[0][$key] +
                            (((($i * array_sum($frec)) / 10) - $frec_acum[$key - 1]) / $frec[$key]) * $ancho;
                        break;
                    }
                }
            }
        }
        return $deciles;
    }

    static function percentiles($datos,$group){
        $frec = Dvarchar::freq($datos, $group);
        $frec_acum = Dvarchar::freqacum($datos, $group);
        $intervalos = Dvarchar::f_group($datos,$group);
        $ancho = Dvarchar::width($datos,$group);

        $percentiles = array();
        for($i = 1; $i < 100; $i++) {
            foreach ($frec_acum as $key => $dato) {
                if ((array_sum($frec) * $i) / 100 <= $dato) {
                    if ($frec[$key] === 0) {
                        $percentiles[] = $intervalos[0][$key];
                        break;
                    }else if ($key === 0) {
                        $percentiles[] = $intervalos[0][$key] +
                            (((($i * array_sum($frec)) / 100) - $frec_acum[$key]) / $frec[$key]) * $ancho;
                        break;
                    } else if ($key > 0) {
                        $percentiles[] = $intervalos[0][$key] +
                            (((($i * array_sum($frec)) / 100) - $frec_acum[$key - 1]) / $frec[$key]) * $ancho;
                        break;
                    }
                }
            }
        }
        return $percentiles;
    }

    static function cuartiles($datos,$group){
        $frec = Dvarchar::freq($datos, $group);
        $frec_acum = Dvarchar::freqacum($datos, $group);
        $intervalos = Dvarchar::f_group($datos,$group);

        $cuartiles = array();
        for($i = 1; $i < 4; $i++) {
            foreach ($frec_acum as $key => $dato) {
                if ((array_sum($frec) * $i) / 4 <= $dato) {
                    if ($frec[$key] === 0) {
                        $cuartiles[] = $intervalos[0][$key];
                        break;
                    }else if ($key === 0) {
                        $cuartiles[] = $intervalos[0][$key] +
                            (((($i * array_sum($frec)) / 4) - $frec_acum[$key]) / $frec[$key]) *
                            Dvarchar::width($datos,$group);
                        break;
                    } else if ($key > 0) {
                        $cuartiles[] = $intervalos[0][$key] +
                            (((($i * array_sum($frec)) / 4) - $frec_acum[$key - 1]) / $frec[$key]) *
                            Dvarchar::width($datos,$group);
                        break;
                    }
                }
            }
        }
        return $cuartiles;
    }

    static function freqre($datos, $group){
        $freqre = array();
        for($i = 0; $i < $group; $i++){
            $freqre[] = Dvarchar::freq($datos, $group)[$i] / array_sum(Dvarchar::freq($datos, $group));
        }
        return $freqre;
    }

    static function puntos_selectos($oneX, $oneY, $twoX, $twoY)
    {
        $unoX = substr($oneX, 0, strpos($oneX, ' '));
        $dosX = substr($twoX, 0, strpos($twoX, ' '));

        if ($unoX > $dosX || $dosX < $unoX) {
            $a1 = ($oneY - $twoY) / ($unoX - $dosX);
            $a1_x = $a1 * $dosX;

            if ($a1_x < 0) {
                $a1_x = abs($a1_x);
            }

            $a0 = $twoY + $a1_x;

            return $puntos = array(
                'Punto 1' =>
                    array(
                        'X' => $twoX,
                        'Y' => $a0 + ($a1 * $dosX)),
                'Punto 2' =>
                    array(
                        'X' => $oneX,
                        'Y' => $a0 + ($a1 * $unoX))
            );

        } else if ($dosX > $unoX || $unoX < $dosX) {
            $a1 = ($twoY - $oneY) / ($dosX - $unoX);
            $a1_x = $a1 * $unoX;

            if ($a1_x < 0) {
                $a1_x = abs($a1_x);
            }

            $a0 = $oneY + $a1_x;

            return $puntos = array(
                'Punto 1' =>
                    array(
                        'X' => $oneX,
                        'Y' => $a0 + ($a1 * $unoX)),
                'Punto 2' =>
                    array(
                        'X' => $twoX,
                        'Y' => $a0 + ($a1 * $dosX))
            );
        }
        return null;
    }

    static function num_comb($n, $k){
        if($n >= $k && $k >= 0 && $n >= 0){
            return gmp_intval( gmp_fact( $n ) ) / ( gmp_intval( gmp_fact($k) ) * gmp_intval( gmp_fact($n - $k) ) );
        }else {
            return 'Tanto el numero de pruebas como de exitos deben ser mayor a 0, el numero de exitos no puede ser mayor'.
            ' al de pruebas';
        }
    }

    static function dist_binomial($n, $k, $p){
        $fun_bin = array();
        if($p > 0 && $p < 1 && $n >= $k && $k >= 0 && $n >= 0){
            for($i = $k; $i >= 0; $i--) {
                $fun_bin[] = Dvarchar::num_comb($n, $k - $i) * (pow($p, $k - $i)) * (pow((1 - $p), ($n - ($k - $i))));
            }
            return $array = array(
                'X' => $fun_bin[$k],
                'Maximo X' => array_sum($fun_bin)
            );
        }else {
            return 'Datos incorrectos';
        }
    }

    static function media_binomial($n, $p){
        if($n > 0 && $p > 0 && $p < 1){
            return $n * $p;
        }else {
            return 'Datos incorrectos';
        }
    }

    static function varianza_binomial($n, $p){
        if($n > 0 && $p > 0 && $p < 1){
            return $n * $p * (1 - $p);
        }else {
            return 'Datos incorrectos';
        }
    }

    static function desves_binomial($n, $p){
        if($n > 0 && $p > 0 && $p < 1){
            return sqrt( Dvarchar::varianza_binomial($n, $p) );
        }else {
            return 'Datos incorrectos';
        }
    }

    static function intervalosTwoColums($arrayDispOne, $group){
        $x = Dvarchar::getData($arrayDispOne);
        sort($x);
        $f1 = null;
        for($i = 0; $i < count($x); $i++){
            $pos = strpos($x[$i],'.');
            if($pos !== false){
                $str = count(substr($x[$i],$pos + 1));
                if($str == 1){
                    $f1 = $x[0] - 0.25;
                }else if($str == 2){
                    $f1 = $x[0] - 0.125;
                }else if($str == 3){
                    $f1 = $x[0] - 0.0625;
                }
            }else {
                $f1 = $x[0] - 0.5;
            }
        }

        $rango = $x[count($x) - 1] - $x[0] + 1;
        $ancho = ceil( $rango / $group );

        $fi = array();
        $ff = array();

        for($i = 0; $i < $group; $i++){
            $fi[$i] = $f1;
            $f1 = $f1 + $ancho;
            $ff[$i] = $f1;
        }
        return  $f_group = array(0 => $fi, 1 => $ff);
    }

    static function getData($arrayDisp){
        $array = array();

        foreach ($arrayDisp as $numerico) {
            $array[] = $numerico->content;
        }

        return $array;
    }

    static function twocolumns($arrayDispOne, $arrayDispTwo, $group){
        $intervalos = Dvarchar::intervalosTwoColums($arrayDispOne, $group);
        $x = Dvarchar::getData($arrayDispOne);
        $y = Dvarchar::getData($arrayDispTwo);
        $array = null;
        $X = array();
        $Y = array();

        for($i = 0; $i < count($x); $i++){
            $array[] = $x[$i] . '-' . $y[$i];
        }

        sort($array);

        for($i = 0; $i < count($x); $i++){
            if( strpos($array[$i], '-') ){
                $X[] = substr( $array[$i], 0, strpos( $array[$i], '-' ) );
                $Y[] = substr( $array[$i], strpos( $array[$i], '-' ) + 1 );
            }else{
                $X = null;
                $Y = null;
            }
        }

        $count = array();
        $count[] =array_values( array_count_values($X) );

        $arrayT = array();
        $acum = 0;
        for($i = 0; $i < count($count[0]) ; $i++){
            $arrayT[] = array_slice($Y, $acum, $count[0][$i]);
            $acum = $acum + $count[0][$i];
        }

        $arrayY = array();
        for($i = 0; $i < count($arrayT) ; $i++){
            $arrayY[] = array_sum($arrayT[$i]) / count($arrayT[$i]);
        }

        $arrayX = array_unique($X);
        $arrayXY = array_combine($arrayX,$arrayY);

        $cont = 0;
        $megaY = array();
        $ar = array_keys($arrayXY);

        for($i = 0; $i < $group ; $i++) {
            foreach($ar as $key) {
                if ($key > $intervalos[0][$i] && $key < $intervalos[1][$i]) {
                    $cont = $cont + $arrayXY[$key];
                    $megaY[] = $cont;
                } else {
                    $cont = 0;
                    $megaY[] = $cont;
                }
            }

        }

        $chunk = array_chunk($megaY, ( $group * count($arrayXY) ) / $group);
        $defY= array();
        for($i = 0; $i < count($chunk) ; $i++){
            $defY[] = max($chunk[$i]);
        }

        return array(
            $intervalos, $defY
        );
    }
}

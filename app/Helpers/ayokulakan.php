<?php
require_once( __DIR__ .'/spipu/autoload.php');
use Spipu\Html2Pdf\Html2Pdf;

if (!function_exists('DisplayStatusRole')){
  function DisplayStatusRole($string) {
    $return = '-';
    switch ($string)
    {
        case 'User Proyek': $return = 'Proyek';
        break;
        case 'User Head Office': $return = 'Head Office';
        break;
        case 'User Divisi': $return = 'Wilayah';
        break;
    }

    return $return;
  }
}

if (!function_exists('wrapText')){
  function wrapText($string) {
    return wordwrap($string, 50, '<br>\n');
  }
}

if (!function_exists('formatEnMonth')){
  function formatEnMonth($bulan) {
    $blnInt = 0;
    switch ($bulan)
    {
        case 'Januari': $blnInt = 'January';
        break;
        case 'Februari': $blnInt = 'February';
        break;
        case 'Maret': $blnInt = 'March';
        break;
        case 'April': $blnInt = 'April';
        break;
        case 'Mei': $blnInt = 'May';
        break;
        case 'Juni': $blnInt = 'June';
        break;
        case 'Juli': $blnInt = 'July';
        break;
        case 'Agustus': $blnInt = 'August';
        break;
        case 'September': $blnInt = 'September';
        break;
        case 'Oktober': $blnInt = 'October';
        break;
        case 'November': $blnInt = 'November';
        break;
        case 'Desember': $blnInt = 'December';
        break;
    }

    return $blnInt;
  }
}

if (!function_exists('formatNumMonth')){
  function formatNumMonth($bulan) {
    $blnInt = 0;
    switch ($bulan)
    {
        case 'Januari': $blnInt = 1;
        break;
        case 'Februari': $blnInt = 2;
        break;
        case 'Maret': $blnInt = 3;
        break;
        case 'April': $blnInt = 4;
        break;
        case 'Mei': $blnInt = 5;
        break;
        case 'Juni': $blnInt = 6;
        break;
        case 'Juli': $blnInt = 7;
        break;
        case 'Agustus': $blnInt = 8;
        break;
        case 'September': $blnInt = 9;
        break;
        case 'Oktober': $blnInt = 10;
        break;
        case 'November': $blnInt = 11;
        break;
        case 'Desember': $blnInt = 12;
        break;
    }

    return $blnInt;
  }
}

if (!function_exists('formatStringMonth')){
  function formatStringMonth($bulan) {
    $blnInt = 0;
    switch ($bulan)
    {
        case '01': $blnInt = 'Januari';
        break;
        case '02': $blnInt = 'Februari';
        break;
        case '03': $blnInt = 'Maret';
        break;
        case '04': $blnInt = 'April';
        break;
        case '05': $blnInt = 'Mei';
        break;
        case '06': $blnInt = 'Juni';
        break;
        case '07': $blnInt = 'Juli';
        break;
        case '08': $blnInt = 'Agustus';
        break;
        case '09': $blnInt = 'September';
        break;
        case '10': $blnInt = 'Oktober';
        break;
        case '11': $blnInt = 'November';
        break;
        case '12': $blnInt = 'Desember';
        break;
    }

    return $blnInt;
  }
}

if (!function_exists('DiffMnY')){
  function DiffMnY($bulan, $tahun) {
    $start = Carbon\Carbon::parse('first day of '.formatEnMonth($bulan).' '.$tahun);
    $end = Carbon\Carbon::parse('last day of '.formatEnMonth($bulan).' '.$tahun);

    return $start->diffInDays($end);
  }
}

if (!function_exists('DateToSql')) {
    function DateToSql($date) {
        if($date != NULL)
        {
            $pecah = explode(" ", $date);
            $tglStr = str_replace(",", "", $pecah[1]);
            if(strlen($tglStr) == 1)
            {
                $tglStr = "0".$tglStr;
            }
            $thnStr = $pecah[2];
            $blnStr = "";
            switch ($pecah[0])
            {
                case 'Januari': $blnStr = '01';
                break;
                case 'Februari': $blnStr = '02';
                break;
                case 'Maret': $blnStr = '03';
                break;
                case 'April': $blnStr = '04';
                break;
                case 'Mei': $blnStr = '05';
                break;
                case 'Juni': $blnStr = '06';
                break;
                case 'Juli': $blnStr = '07';
                break;
                case 'Agustus': $blnStr = '08';
                break;
                case 'September': $blnStr = '09';
                break;
                case 'Oktober': $blnStr = '10';
                break;
                case 'November': $blnStr = '11';
                break;
                case 'Desember': $blnStr = '12';
                break;
            }
            return $thnStr."-".$blnStr."-".$tglStr;
        }else{
            return NULL;
        }
    }
}

if (!function_exists('DateToSqlEn')) {
    function DateToSqlEn($date) {
        if($date != NULL)
        {
            $pecah = explode(" ", $date);
            $tglStr = str_replace(",", "", $pecah[1]);
            if(strlen($tglStr) == 1)
            {
                $tglStr = "0".$tglStr;
            }
            $thnStr = $pecah[2];
            $blnStr = "";
            switch ($pecah[0])
            {
                case 'January': $blnStr = '01';
                break;
                case 'February': $blnStr = '02';
                break;
                case 'March': $blnStr = '03';
                break;
                case 'April': $blnStr = '04';
                break;
                case 'May': $blnStr = '05';
                break;
                case 'June': $blnStr = '06';
                break;
                case 'July': $blnStr = '07';
                break;
                case 'August': $blnStr = '08';
                break;
                case 'September': $blnStr = '09';
                break;
                case 'October': $blnStr = '10';
                break;
                case 'November': $blnStr = '11';
                break;
                case 'December': $blnStr = '12';
                break;
            }
            return $thnStr."-".$blnStr."-".$tglStr;
        }else{
            return NULL;
        }
    }
}

if (!function_exists('DayOf')) {
    function DayOf($date){
      switch ($date->format('l'))
      {
          case 'Sunday': return 'Minggu';
          break;
          case 'Monday': return 'Senin';
          break;
          case 'Tuesday': return 'Selasa';
          break;
          case 'Wednesday': return 'Rabu';
          break;
          case 'Thursday': return 'Kamis';
          break;
          case 'Friday': return 'Jumat';
          break;
          case 'Saturday': return 'Sabtu';
          break;
      }
    }
}

if (!function_exists('imageShow')) {
    function imageShow($file) {
      if($file->count() > 0)
      {
          $str = explode(".",$file->first()->url);

          if(strtolower($str[1]) == 'jpeg' || strtolower($str[1]) == 'png' || strtolower($str[1]) == 'jpg')
          {
              return url('storage/'.$file->first()->url);
          }

          return asset('img/archive.png');
      }
      return asset('img/no-images.png');
    }
}

if (!function_exists('singleImageShow')) {
    function singleImageShow($file) {
      $str = explode(".",$file->url);

      if(strtolower($str[1]) == 'jpeg' || strtolower($str[1]) == 'png' || strtolower($str[1]) == 'jpg')
      {
          return url('storage/'.$file->url);
      }

      return asset('img/archive.png');
    }
}

if (!function_exists('DateToString')) {
    function DateToString($date) {
        if(!$date)
        {
            return '-';
        }
        $tgl = $date->format('Y-m-d');
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'Januari';
            break;
            case '02': $blnStr = 'Februari';
            break;
            case '03': $blnStr = 'Maret';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'Mei';
            break;
            case '06': $blnStr = 'Juni';
            break;
            case '07': $blnStr = 'Juli';
            break;
            case '08': $blnStr = 'Agustus';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'Oktober';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'Desember';
            break;
        }
        return $blnStr." ".$tglStr." ".$thnStr;
    }
}

if (!function_exists('DateToStringWday')) {
    function DateToStringWday($date) {
        if(!$date)
        {
            return '-';
        }
        $tgl = $date->format('Y-m-d');
        $pecah = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2].",";
        $blnStr = "";
        switch ($pecah[1])
        {
            case '01': $blnStr = 'Januari';
            break;
            case '02': $blnStr = 'Februari';
            break;
            case '03': $blnStr = 'Maret';
            break;
            case '04': $blnStr = 'April';
            break;
            case '05': $blnStr = 'Mei';
            break;
            case '06': $blnStr = 'Juni';
            break;
            case '07': $blnStr = 'Juli';
            break;
            case '08': $blnStr = 'Agustus';
            break;
            case '09': $blnStr = 'September';
            break;
            case '10': $blnStr = 'Oktober';
            break;
            case '11': $blnStr = 'November';
            break;
            case '12': $blnStr = 'Desember';
            break;
        }
        return DayOf($date)." / ".$blnStr." ".$tglStr." ".$thnStr;
    }
}

if (!function_exists('statusReview')) {
    function statusReview($status, $url = null) {
        switch ($status)
        {
            case 0: return '<a class="ui tag label" href="'.$url.'">Belum Dibaca</a>';
            break;
            case 1: return '<a class="ui teal tag label" href="'.$url.'">Sudah Dibaca</a>';
            break;
        }
    }
}

if (!function_exists('statusLabel')) {
    function statusLabel($status, $url) {
        switch ($status)
        {
            case 0: return '<a href="'.url($url).'" class="ui orange ribbon label">Belum Dibaca</a>';
            break;
            case 1: return '<a href="'.url($url).'" class="ui teal ribbon label">Sudah Dibaca</a>';
            break;
        }
    }
}

if (!function_exists('statusTindakan')) {
    function statusTindakan($status) {
        switch ($status)
        {
            case 0: return '<a href="javascript:void(0)" class="ui orange tag label">Belum Selesai</a>';
            break;
            case 1: return '<a href="javascript:void(0)" class="ui teal tag label">Selesai</a>';
            break;
        }
    }
}

if (!function_exists('imageItem')) {
  function imageItem($picture) {
      if($picture)
      {
        return '<img src="'.url('storage/'.$picture).'" style="height:8rem">';
      }
      return '<img src="'.asset('img/no-images.png').'" style="height:8rem">';
  }
}

if (!function_exists('readMoreText')) {
    function readMoreText($value, $maxLength = 150)
    {
        $return = textarea($value);
        if (strlen($value) > $maxLength) {
            $return = substr(textarea($value), 0, $maxLength);
            $readmore = substr(textarea($value), $maxLength);

            $return .= '<a href="javascript: void(0)" class="read-more text-info" onclick="$(this).parent().find(\'.read-more-cage\').show(); $(this).hide()">&nbsp;&nbsp;Selengkapnya...</a>';

            $readless = '<a href="javascript: void(0)" class="read-less text-info" onclick="$(this).parent().parent().find(\'.read-more\').show(); $(this).parent().hide()">&nbsp;&nbsp;Kecilkan...</a>';

            $return = "<span>{$return}<span style='display: none' class='read-more-cage'>{$readmore} {$readless}</span></span>";
        }
        return $return;
    }
}

if (!function_exists('stringTakenAt')) {
    function stringTakenAt($taken, $waktu, $tanggal)
    {
        $pecah = explode(" ", $waktu);
        $p = explode(":", $pecah[0]);
        $hours = (int)$p[0];
        $minutes = (int)$p[1];
        if($pecah[1] == 'PM')
        {
            $hours = $hours + 12;
        }
        $ex = explode(" ", $tanggal);

        $fullDate = Carbon\Carbon::parse($ex[0]." ".$hours.":".$minutes.":00");
        $diff = $fullDate->diffInHours($taken);
        if($diff > 2)
        {
            return '<span style="font-size:10px;color:red;"><i>Data diambil diatas 2 jam pada : '.$taken->format('F d, Y (H:i:s)').'</i></span>';
        }
        return '<span style="font-size:10px;color:green;"><i>Data diambil dibawah 2 jam pada : '.$taken->format('F d, Y (H:i:s)').'</i></span>';
    }
}

if (!function_exists('textarea')) {
	function textarea($text)
	{
		$new = '';

		$new = str_replace("\n", "<br>", $text);

		return $new;
	}
}


if(!function_exists('HTML2PDF')){
    function HTML2PDF($content='', $data=[]){
            $komponen['file_name'] = 'default';
            $komponen['page'] = 'P'; //P Page atau L lanscape

            $data = array_merge($komponen,$data);

            ob_start();
            ob_end_clean();
            $content = $content;
            $html2pdf = New Html2Pdf($data['page'], 'A4', 'fr', true, 'UTF-8', array(5, 5, 5, 5));
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);
            $html2pdf->output($data['file_name'].'.pdf');
    }
}

if (!function_exists('column_letter')) {
    function column_letter($c) {

        $c = intval($c);

        if ($c <= 0)
            return '';

        $letter = '';
        while($c != 0){
           $p = ($c - 1) % 26;
           $c = intval(($c - $p) / 26);
           $letter = chr(65 + $p) . $letter;
        }

        return $letter;
    }
}

if (!function_exists('numDay')) {
    function numDay($day) {
        if($day != NULL)
        {
            $blnStr = "";
            switch ($day)
            {
                case '0': $blnStr = 'Senin';
                break;
                case '1': $blnStr = 'Selasa';
                break;
                case '2': $blnStr = 'Rabu';
                break;
                case '3': $blnStr = 'Kamis';
                break;
                case '4': $blnStr = 'Jumat';
                break;
                case '5': $blnStr = 'Sabtu';
                break;
                case '6': $blnStr = 'Minggu';
                break;
            }
            return $blnStr;
        }else{
            return '';
        }
    }
}

if (!function_exists('ipAddress')) {
    function ipAddress(){
        switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
    }
}

if (!function_exists('slugify')) {
    function slugify($text){
          // replace non letter or digits by -
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);

          // transliterate
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

          // remove unwanted characters
          $text = preg_replace('~[^-\w]+~', '', $text);

          // trim
          $text = trim($text, '-');

          // remove duplicate -
          $text = preg_replace('~-+~', '-', $text);

          // lowercase
          $text = strtolower($text);

          if (empty($text)) {
            return 'n-a';
          }

          return $text;
        }
}

if (!function_exists('generateOrder')) {
    function generateOrder($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('convertfilesize')) {
    function convertfilesize()
    {
       $size = ini_get('upload_max_filesize');

        switch(substr($size, -1))
        {
            case 'G': $return = (int)rtrim($size,substr($size, -1)).'000000000';
            break;
            case 'M': $return = (int)rtrim($size,substr($size, -1)).'000000';
            break;
            default : $return = (int)$size;
            break;
        }

        return $return;
    }
}

 function curlsPost($url='', $head = array(), $json = array()){
    $ch  = \curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FAILONERROR, 0);

    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);
}

 function curlsGet($url='', $head = array(), $json = array()){
    $ch  = \curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);
}

function checkMime($mime = '')
{
    $return = false;
    if($mime == "image/png"){
      $return = true;
    }elseif($mime == "image/jpg"){
      $return = true;
    }elseif($mime == "image/jpeg"){
      $return = true;
    }elseif($mime == "image/gif"){
      $return = true;
    }elseif($mime == "gif"){
      $return = true;
    }elseif($mime == "jpeg"){
      $return = true;
    }elseif($mime == "jpg"){
      $return = true;
    }elseif($mime == "png"){
      $return = true;
    }elseif($mime == "tiff"){
      $return = true;
    }else{
      $return = false;
    }

    return $return;
}
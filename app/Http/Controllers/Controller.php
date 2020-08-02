<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Berita\Berita;
use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriRental;
use App\Models\Barang\FavoritBarang;
use App\Models\Master\KategoriBarangChild;
use App\Models\Master\KategoriBarangSub;
use App\Models\Chat\Chat;
use App\Models\User;
use App\Models\Notification\NotifFeedback;
use App\Models\Barang\LapakBarang;
use App\Models\Favorit\LikeFavoritBarang;
use Carbon\Carbon;

use DataTables;
use Auth;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Mail\SendMail;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $breadcrumb = ["Home" => "#"];
    private $link = "";
    private $group = "";
    private $subGroup = "";
    private $title = "Title";
    private $subtitle = " ";
    private $tableStruct = [];

    private $modalSize = "lg";

    public function setBreadcrumb($value=[])
    {
        $this->breadcrumb = $value;
    }

    public function pushBreadCrumb($value=[])
    {
        array_push($this->breadcrumb, $value);
    }

    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    public function setTableStruct($value=[])
    {
      $this->tableStruct = $value;
    }

  

    public function setTableUrl($value='')
    {
      $this->tableUrl = $value;
    }


    public function getTableStruct()
    {
      return $this->tableStruct;
    }

    public function setTitle($value="")
    {
      $this->title = $value;
    }

    public function getTitle()
    {
      return $this->title;
    }

    public function setSubtitle($value="")
    {
      $this->subtitle = $value;
    }

    public function getSubtitle()
    {
      return $this->subtitle;
    }

    public function setLink($value="")
    {
        $this->link = $value;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setGroup($value="")
    {
        $this->group = $value;
    }

    public function getGroup()
    {
        return $this->group;
    }
    public function setSubGroup($value="")
    {
        $this->subGroup = $value;
    }

    public function getSubGroup()
    {
        return $this->subGroup;
    }

    public function setModalSize($value="sm")
    {
      $this->modalSize = $value;
    }

    public function getModalSize()
    {
      return $this->modalSize;
    }

    public function render($view, $additional=[])
    {
        $keranjang = [];
        $sewa = [];
        $favorit = 0;
        $notifFeedback = [];
        if(Auth::check()){
            $keranjang = FavoritBarang::where('form_type','img_barang')->where('user_id',auth()->user()->id)->get();
            $sewa = FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->get();
            $notifFeedback = NotifFeedback::where('user_id',auth()->user()->id)->where('review',1)->get();
            $favorit = LikeFavoritBarang::where('user_id',auth()->user()->id)->count();
        }
        $date = Carbon::now();
        $lapakBaru = LapakBarang::with('kategoriBarang','lapak')->whereHas('lapak',function($q) use($date){
            $q->whereMonth('created_at',$date->format('m'))->whereYear('created_at',$date->format('Y'));
          })->paginate(10);
         $promo = Berita::where('kategori','Promosi')->orderBy('created_at','desc')->first();
          $iklan = Berita::where('kategori','Iklan')->orderBy('created_at','desc')->first();
          $diskon = Berita::where('kategori','Diskon')->orderBy('created_at','desc')->first();
        $data = [
         'breadcrumb' => $this->breadcrumb,
         'title'    => $this->title,
            'subtitle'   => $this->subtitle,
            'pageUrl'    => $this->link,
            'group'      => $this->group,
            'subGroup'   => $this->subGroup,
            'modalSize'  => $this->modalSize,
            'tableStruct'=> $this->tableStruct,
            'keranjang'  => $keranjang,
            'sewa'  => $sewa,
            'lapakBaru'  => $lapakBaru,
            'notifFeedback'  => $notifFeedback,
            'mockup'     => true,
            'kategoriBarang' => KategoriBarang::select('*'),
            'kategoriRental' => KategoriRental::select('*'),
            'kategoriRental1' => KategoriRental::orderByRaw('nama','desc')->get(),
            'subkategori' => KategoriBarangSub::get(),
            'favorit' => $favorit,
             'promo' => $promo,
            'iklan' => $iklan,
            'diskon' => $diskon,
            'notifChat' => Chat::where('status',1)->count(),

        ];

    return view($view, array_merge($data, $additional));
    }

    public function downloadButton($params = [])
    {
        return '<button type="button" data-id="'.$params['id'].'" data-type="'.$params['type'].'" class="ui mini blue icon incl-multi-download button"><i class="download icon"></i></button>';
    }

    public function makeButton($params = [])
    {
        $settings = [
            'urls'    => 'others',
            'class'    => 'blue',
            'label'    => 'Button',
            'tooltip'  => '',
            'placement'  => '',
            'target'   => url('/'),
            'disabled' => '',
        ];

        $btn = '';
        $datas = '';
        $attrs = '';

        if (isset($params['datas'])) {
            foreach ($params['datas'] as $k => $v) {
                $datas .= " data-{$k}=\"{$v}\"";
            }
        }

        if (isset($params['attributes'])) {
            foreach ($params['attributes'] as $k => $v) {
                $attrs .= " {$k}=\"{$v}\"";
            }
        }

        switch ($params['type']) {
             case "add-use":
                $settings['class']   = 'green icon delete';
                $settings['label']   = '<i class="users icon"></i>';
                $settings['tooltip'] = 'Add Tenaga Harian';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "delete":
                $settings['class']   = 'btn btn-sm btn-danger deletes';
                $settings['label']   = '<i class="fa fa-close"></i>';
                $settings['tooltip'] = 'Hapus Data';
                $settings['placement'] = 'bottom';

                $params  = array_merge($settings, $params);
                $extends = "data-toggle='tooltip' data-placement='{$params['placement']}' title='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='btn btn-sm btn-danger {$params['class']}' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "edit":
                $settings['class']   = 'btn btn-sm btn-success edit';
                $settings['label']   = '<i class="fa fa-edit"></i>';
                $settings['tooltip'] = 'Ubah Data';
                $settings['placement'] = 'bottom';

                $params  = array_merge($settings, $params);
                $extends = " data-toggle='tooltip' data-placement='{$params['placement']}' title='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='{$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                 break;
            case "approve":
                $settings['class']   = 'btn btn-sm btn-warning approve';
                $settings['label']   = '<i class="fa fa-check"></i>';
                $settings['tooltip'] = 'Approve Data';
                $settings['placement'] = 'bottom';

                $params  = array_merge($settings, $params);
                $extends = " data-toggle='tooltip' data-placement='{$params['placement']}' title='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='{$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                 break;
            case "others":
                $settings['class']   = 'orange icon others';
                $settings['label']   = '<i class="fa fa-plus"></i>';
                $settings['tooltip'] = 'Ubah Data';
                $settings['urls'] = 'others';

                $params  = array_merge($settings, $params);
                $extends = "data-url='{$params['urls']}' data-content='{$params['tooltip']}' data-id='{$params['id']}' ";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                 break;
            case "edit-page":
                $settings['class']   = 'btn btn-sm btn-pink edit';
                $settings['label']   = '<i class="fa fa-edit"></i>';
                $settings['tooltip'] = 'Ubah Data';
                $settings['placement'] = 'bottom';
                
                $params  = array_merge($settings, $params);
                $extends = " data-toggle='tooltip' data-placement='{$params['placement']}' title='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='{$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                 break;
          
            case "detail":
                $settings['class']   = 'btn btn-sm btn-warning detail';
                $settings['label']   = '<i class="fa fa-eye"></i>';
                $settings['tooltip'] = 'Detail Data';
                $settings['placement'] = 'bottom';

                $params  = array_merge($settings, $params);
                $extends = " data-toggle='tooltip' data-placement='{$params['placement']}' title='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='{$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                 break;
            case "detail-page":
              $settings['class']   = 'green icon detail-page';
              $settings['label']   = '<i class="eye icon"></i>';
              $settings['tooltip'] = 'Detail';

              $params  = array_merge($settings, $params);
              $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

              $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";

                break;
          case "view-page":
              $settings['class']   = 'teal icon view-page';
              $settings['label']   = '<i class="eye icon"></i>';
              $settings['tooltip'] = 'Detail';

              $params  = array_merge($settings, $params);
              $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

              $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
              break;
          case "target-blank":
              $settings['class']   = 'green icon';
              $settings['label']   = '<i class="download icon"></i>';
              $settings['tooltip'] = 'Download File';

              $params  = array_merge($settings, $params);
              $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

              $btn = "<a href='{$params['target']}' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']} target='_blank'>{$params['label']}</a>\n";
          break;
          case "modal":
              $settings['class']   = 'orange icon edit';
              $settings['label']   = '<i class="edit icon"></i>';
              $settings['tooltip'] = 'Ubah Data';

              $params  = array_merge($settings, $params);
              $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

              $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
            break;
            case "url":
            default:
                $settings['class']   = 'blue icon';
                $settings['label']   = '<i class="eye icon"></i>';

                $params  = array_merge($settings, $params);
                $extends = '';
                if($params['tooltip'] != '')
                {
                    $extends = " data-content='{$params['tooltip']}'";
                }

                $btn = "<a href='{$params['target']}' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</a>\n";
        }

        return $btn;
    }

    public function messageApiJson($status='',$data='')
    {
        if($status == 'true'){
            if(isset(collect($data)['current_page'])){
                $data1 = [
                    'status' => true,
                    'message' => 'Sukses!',
                ];
                $show = array_merge($data1,$data->toArray());
                return response()->json($show);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'Sukses!',
                    'total_data' => $data->count(),
                    'data' => $data,
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data Kosong!',
                'data' => [],
            ]);
        }
    }

     public function messageApiJsonObject($status='',$data='')
    {
        if($status == 'true'){
            if(isset(collect($data)['current_page'])){
                $data1 = [
                    'status' => true,
                    'message' => 'Sukses!',
                ];
                $show = array_merge($data1,$data->toArray());
                return response()->json($show);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'Sukses!',
                    // 'total_data' => count($data),
                    'data' => $data,
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data Kosong!',
                'data' => [],
            ]);
        }
    }

    public function messageApiJsonGet($status='',$data='')
    {
        if($status == 'true'){
            if(isset(collect($data->get())['current_page'])){
                $data1 = [
                    'status' => true,
                    'message' => 'Sukses!',
                ];
                $show = array_merge($data1,$data->get()->toArray());
                return response()->json($show);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'Sukses!',
                    'total_data' => $data->get()->count(),
                    'data' => $data->get(),
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data Kosong!',
                'data' => [],
            ]);
        }
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    // GLOBAL SEND MAIL
    public function sendMailGlobal($email='',$record=[],$title='',$subtitle = '',$url='',$linkName = 'Go to Ling',$view='',$img=''){
        Mail::to($email)->send(new SendMail($email,$record,$title,$subtitle,$url,$linkName,$view,$img));
    }
}

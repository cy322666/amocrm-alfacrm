<?php

namespace App\Models\Bizon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Viewer extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $table = 'bizon_viewers';

    protected $fillable = [
        'chatUserId',
        'lead_id'   ,
        'note_id'   ,
        'contact_id',
        'time'      ,
        'phone'     ,
        'webinarId' ,
        'view'      ,
        'viewTill'  ,
        'email'     ,
        'username'  ,
        'roomid'    ,
        'url'       ,
        'ip'        ,
        'useragent' ,
        'created'   ,
        'playVideo' ,
        'finished'  ,
        'messages_num',
        'cv'        ,
        'cu1'       ,
        'p1'        ,
        'p2'        ,
        'p3'        ,
        'referer'   ,
        'city'      ,
        'region'    ,
        'newOrder'  ,
        'country'   ,
        'tz'        ,
        'mob'       ,
        'utm_term'  ,
        'utm_campaign',
        'commentaries',
        'clickBanner' ,
        'clickFile',
        'newOrder',
        'orderDetails',
        'type'
    ];

    //возможность сортировки по полям
    protected $allowedSorts = [
        'status',
        'created_at',
        'updated_at',
    ];

    //возможность фильтрация по полям
    protected $allowedFilters = [];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public static function getType(Setting $setting, ?int $time) : string
    {
        return match (true) {

            $time >= $setting->time_cold &&
            $time <= $setting->time_soft => 'soft',

            $time >= $setting->time_soft => 'hot',

            $time <= $setting->time_soft => 'cold',
        };
    }

    public function getStatusId(Setting $setting) : ?int
    {
        $status_type = 'status_id_'.$this->type;

        return $setting->$status_type ?? null;
    }

    public function getTagType(Setting $setting) : ?string
    {
        if($this->type) {

            $tag_type = 'tag_'.$this->type;
        }
        return $setting->$tag_type ?? null;
    }

    public function getResponsibleType(Setting $setting) : ?string
    {
        if($this->type) {

            $responsible_type = 'staff_id_'.$this->type;
        }
        return $setting->$responsible_type ?? $setting->staff_id_default;
    }

    public static function getTime(mixed $viewTill, mixed $view): int
    {
        if($viewTill && $view) {

            return (int)round((((int)$viewTill - (int)$view) / 1000) / 60);
        } else
            return 0;
    }

    public function convertToDate(string $microtime): int
    {
        return (int)round(((int)$microtime / 1000) / 60);
    }

    public function convertToString($value): string
    {
        if ($value === null || $value === false || $value === 0) return 'Нет';
        else
            return 'Да';
    }

    public function createTextForNote(): string
    {
        $note = [
            "Информация о зрителе",
            '----------------------',
            ' - Ник : ' . $this->username,
            ' - Телефон : ' . $this->phone,
            ' - Почта : ' . $this->email,
            ' - Город : ' . $this->city,
            ' - Присутствовал : ' .$this->getTime($this->viewTill, $this->view). ' мин',
            ' - Когда зашел : ' . $this->convertToDate($this->view),
            ' - Когда вышел : ' . $this->convertToDate($this->viewTill),
            ' - Присутствовал до конца : ' .$this->convertToString($this->userFinished),
            ' - Кликал по банеру : ' . $this->convertToString($this->clickBanner),
            ' - Кликал по кнопке : ' . $this->convertToString($this->clickFile),
            ' - Комментарии : ' . "\n    ".implode("\n    ", json_decode($this->commentaries) ?? []),
        ];
        $note = implode("\n", $note);

        if($this->newOrder) {

            $noteOrder = [
                " ",
                "Информация о заказе",
                '----------------------',
                ' - ID заказа : ' . $this->newOrder,
                ' - Описание заказа : ' . $this->orderDetails
            ];
            $noteOrder = implode("\n", $noteOrder);

            $note = $note ."\n". $noteOrder;
        }

        return $note;
    }
}

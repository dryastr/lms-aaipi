<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarChapterItem extends Model
{
    protected $table = 'webinar_chapter_items';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    public static $chapterFile = 'file';

    public static $chapterSession = 'session';

    public static $chapterTextLesson = 'text_lesson';

    public static $chapterQuiz = 'quiz';

    public static $chapterAssignment = 'assignment';

    public static function makeItem($userId, $chapterId, $itemId, $type)
    {
        $order = WebinarChapterItem::where('chapter_id', $chapterId)->count() + 1;

        WebinarChapterItem::updateOrCreate([
            'user_id' => $userId,
            'chapter_id' => $chapterId,
            'item_id' => $itemId,
            'type' => $type,
        ], [
            'order' => $order,
            'created_at' => time(),
        ]);
    }

    public static function changeChapter($userId, $oldChapterId, $newChapterId, $itemId, $type)
    {
        $chapterItem = WebinarChapterItem::query()
            ->where('user_id', $userId)
            ->where('chapter_id', $oldChapterId)
            ->where('item_id', $itemId)
            ->where('type', $type)
            ->first();

        if (! empty($chapterItem)) {
            $order = WebinarChapterItem::where('chapter_id', $newChapterId)->count() + 1;

            $chapterItem->update([
                'chapter_id' => $newChapterId,
                'order' => $order,
            ]);
        } else {
            WebinarChapterItem::makeItem($userId, $newChapterId, $itemId, $type);
        }
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'item_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo('App\Models\File', 'item_id', 'id');
    }

    public function textLesson()
    {
        return $this->belongsTo('App\Models\TextLesson', 'item_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\WebinarAssignment', 'item_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'item_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\WebinarChapter', 'chapter_id', 'id');
    }
}

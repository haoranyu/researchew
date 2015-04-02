<?php

class Paper extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'papers';

    public static function getPaperByHash($hash) {
        $paper = static::where('hash', $hash)->first()->toArray();
        $paper['author'] = json_decode($paper['author']);
        return $paper;
    }

    public static function storePaper($id, $title, $abstract, $authors, $date) {
        if(!static::find($id)) {
            $paper = new Paper;
            $paper->id = $id;
            $paper->hash = hash('sha1', $id);
            $paper->title = $title;
            $paper->abstract = $abstract;
            $paper->author = json_encode($authors);
            $paper->date = $date;
            $paper->save();
        }

    }

}

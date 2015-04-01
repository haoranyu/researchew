<?php

class PaperController extends BaseController {

    public function getPaper($hash)
    {
        $paper = Paper::getPaperByHash($hash);

        return View::make('paper')
                ->with('paper', $paper);
    }

}

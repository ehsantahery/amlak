<?php
namespace System\View;

use Exception;
use App\Providers\AppServiceProvider;
use System\View\Traits\HasExtendContent;
use System\View\Traits\HasIncludeContents;
use System\View\Traits\HasViewLoader;

class ViewBuilder{

    use HasViewLoader,HasExtendContent,HasIncludeContents;
    public $contans;
    public $vars = [];


    public function run($dir){
     
       
        $this->contans = $this->viewloader($dir);
        $this->checkExtendsContent();
        $this->checkIncludeContent();
        Composer::setViews($this->ViewArray);
        $this->vars = Composer::getVars();
       
    }
    


}
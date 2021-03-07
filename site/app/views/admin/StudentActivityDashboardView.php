<?php

namespace app\views\admin;


use app\views\AbstractView;

class StudentActivityDashboardView extends AbstractView{

        public function createTable($data_dump){
            $this->core->getOutput()->addInternalCss('table.css');
            
        //var_dump($data_dump);



        return $this->core->getOutput()->renderTwigTemplate("admin/users/StudentActivityDashboard.twig", [
            "data" => $data_dump,
        ]);

        }



}
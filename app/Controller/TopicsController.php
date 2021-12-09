<?php 
    class TopicsController extends AppController{
        public function add(){
            
             //$this->layout('/topics/add2');
            // $this->layout='add2';
            //$value = $this->request->host();
            // $this->set('value',$this->request->here);   
            // $this->set('value',$this->request->base);   
            // $this->set('value',$this->request->webroot);   
            // $this->set('value',$this->request->query);   
            // $this->set('value',$this->request->host());   
            // $this->set('value',$this->request->domain());   
            $this->set('value',$this->request->domain($tldLength=1));

            $this->set('color','pink');
            $this->render('/topics/add2');//used to call any ctp file
        }


        }
        
    }
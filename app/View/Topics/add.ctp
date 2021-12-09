<h1> This is add.ctp file created for Topics</h1>
<?php 
    // $value = $this->request->host();
    echo $value." _Query1 <br>";
    
    echo $color."_Query2 <br>";
    // Anywhere in your application
    CakeLog::write('debug', 'Got here');
    echo ($this->log('Got here', 'debug'));


?>
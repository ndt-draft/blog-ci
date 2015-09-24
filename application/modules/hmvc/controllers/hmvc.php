<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Hmvc extends MX_Controller {
 
   public function index(  )
   {
      $this->load->view('hmvc_view');
      $this->load->spark('example-spark/1.0.0');      # We always specify the full path from the spark folder
		$this->example_spark->printHello();             # echo's "Hello from the example spark!"
   }
}
 
/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */

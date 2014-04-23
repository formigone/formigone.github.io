<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Formigone extends CI_Controller {

   /**********************************************************
   * 
   **********************************************************/
   public function omikuji_fortune_cookie() {
      $this->output->cache(0);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "Omikuji Fortune Cookie &raquo; HTML5 & Android"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("apps/omikuji", null, true),
          "raw_icon" => "public/img/icon-raw/omikuji-fortune-cookie-icon.png"
      );


      $this->load->view("templates/no-billboard", $data);
   }

   /**********************************************************
   * 
   **********************************************************/
   public function speed_reading_trainer_chrome_app_store() {
      header("Location: https://chrome.google.com/webstore/detail/klloefpijaofgelefjimlhdikagaegfe");
   }

   /**********************************************************
   * 
   **********************************************************/
	public function index() {
      $this->output->cache(60);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "Formigone Digital Agency"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "billboard" => $this->load->view("billboard", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("home", null, true)
      );


      $this->load->view("templates/no-billboard", $data);
	}
    
    
    /**********************************************************
     * 
     **********************************************************/
	public function services() {
      $this->output->cache(60);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "Creative Web Solutions"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("services", null, true)
      );


      $this->load->view("templates/no-billboard", $data);
	}
    
    
    /**********************************************************
     * 
     **********************************************************/
	public function products() {
      $this->output->cache(60);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "Web App & Mobile Apps Portfolio"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("products", null, true)
      );


      $this->load->view("templates/no-billboard", $data);
	}
    
    
    /**********************************************************
     * 
     **********************************************************/
	public function contact() {
      $this->output->cache(60);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "Get in touch with Formigone Digital Agency"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("contact", null, true)
      );


      $this->load->view("templates/no-billboard", $data);
	}
    
    
    /**********************************************************
     * 
     **********************************************************/
	public function about() {
      $this->output->cache(60);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "About Formigone Digital Agency"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("about", null, true)
      );


      $this->load->view("templates/no-billboard", $data);
	}
    
    
    /**********************************************************
     * 
     **********************************************************/
	public function email() {
      $this->output->cache(60);
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $message = $this->input->post("message");
        
        $this->load->library("email");
        $this->load->helper("url");

        $this->email->from("noreply@formigone.com", "Formigone Digital Agency");
        $this->email->to("rodrixar@gmail.com");
        $this->email->subject("Message from Formigone.com");
        $this->email->message("
            <p><b>Name</b>: {$name}</p>
            <p><b>Email</b>: <a href='{$email}'>{$email}</a></p>
            <p><b>Message</b>: {$message}</p>
            ");

        $this->email->send();
        redirect("/", "refresh");
	}
    
    
    /**********************************************************
     * 
     **********************************************************/
	public function page_not_found() {
      $this->output->cache(525600 /* A year */);
      $this->load->helper("url");

      $data = array(
          "meta" => array(
              "ga" => "UA-20148108-1",
              "title" => "Page Not Found"
          ),
          "template" => array(
              "footer" => $this->load->view("footer", null, true),
              "billboard" => $this->load->view("billboard", null, true),
              "header" => $this->load->view("header", null, true)
          ),
          "content" => $this->load->view("404", null, true)
      );


      $this->load->view("templates/no-billboard", $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
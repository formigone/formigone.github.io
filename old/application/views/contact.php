<div class="container_12">
    <div class="grid_8">
<h1>Contact us today</h1>
<p>Use the form below get in touch with us. Please allow up to 48 hours for one of our representatives process your message as needed.</p>
<form method="POST" action="<?= base_url(); ?>email" id="contact_form">
<p>Name: <input type="text" class="wide" name="name"/><p>
<p>Email: <input type="text" class="wide" name="email"/><p>
<p>Human detector: <b><span id="detect_num_1"></span> + <span id="detect_num_2"></span> = ?</b> (enter the sum of the two numbers)<input type="text" class="wide" name="sum" id="detect_sum"/><p>
<p>Message: <textarea class="wide" name="message"></textarea><p>
<p><input type="submit" value="Send"/></p>
</form>

    </div>
    <div class="grid_4 sidebar">
        <img src="<?= base_url(); ?>public/img/senior-software-engineer.jpg" alt="Contact a professional from Formigone Digital Agency today"/>
    </div>
</div>


<script>
(function(){
   var num_1 = parseInt(Math.random() * 8) + 1;
   var num_2 = parseInt(Math.random() * 8) + 1;
   var right_answer = num_1 + num_2;

   document.getElementById("detect_num_1").innerText = num_1;
   document.getElementById("detect_num_2").innerText = num_2;

   document.getElementById("contact_form").onsubmit = function(){

      // Make sure math problem is right
      if (right_answer != parseInt(document.getElementById("detect_sum").value)) {
         var res = prompt("In order to verify that you're not a robot, please solve the following math problem:\n"+
                    "  " + num_1 + " + " + num_2 + " = ");
         if (right_answer != res) {
            alert("Incorrect. Try again before submitting your message");
            document.getElementById("detect_sum").focus();
            return false;
         }
      }

      return true;
   };
})();
</script>

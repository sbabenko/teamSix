<div class="FR_newMission"> </div>

<div class="form-new-mission">
 
      <div class="tab-content-a">

         <div id="login-a">   
          <h1>Enter a New Mission</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap-a">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap-a">
            <label>
              Password<span class="req-a">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot-a"><a href="forgot.php">Forgot Password?</a></p>

          </form>

        </div>
          
        <div id="signup">   

          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Create Mission</button>
          
          </form>

        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->

<script>
$(document).ready(function(){
    $("p").click(function(){
        $(this).hide();
    });
});
</script>

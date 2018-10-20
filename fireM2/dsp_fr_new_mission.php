<div class="FR_newMission">New Missions</div>

<div class="form-new-mission">
      
      <ul class="tab-group-a">
        <li class="tab-a">Sign Up</a></li>
      </ul>
      
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
          
          <button class="button-a button-block-a" name="login" />Login</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>Enter Your Credentials</h1>
          
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
          
          <button type="submit" class="button button-block" name="register" />Register</button>
          
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

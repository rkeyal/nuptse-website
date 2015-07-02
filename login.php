	      <form action="/authentication/login.php" method="POST" class="form">
      	      	    <fieldset>
			<label for="email">Email</label>
			<div class="div_text">
			<div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span><input name="email" type="text" id="log inputIcon" value="" class="username span2" placeholder="Email"></div>
			</div>
			<label for="password">Password</label>
			<div class="div_text">
			<div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input name="pwd" type="password" id="pwd inputIcon" class="password span2" placeholder="Password"></div>
                       </div>

		       <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>"><input name="a" type="hidden" value="login">
		       <div class="button_div">
            <label class="checkbox">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever">&nbsp;Remember me&nbsp;&nbsp;</label><input type="submit" name="Submit" value="Login" class="btn btn-primary">
			</div>
	      </fieldset>
	   </form>

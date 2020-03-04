<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signInModalLabel">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="doLogin.php" method="POST">
              <div class="input-group form-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><img src="img/icons/envelope.svg" alt="asd"></span>
                  </div>
                  <input name="email" type="email" class="form-control" placeholder="Email">
                  
              </div>
              <div class="input-group form-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><img src="img/icons/shield-lock.svg" alt="asd"></span>
                  </div>
                  <input name="password" type="password" class="form-control" placeholder="Password">
              </div>  
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <!--<button class="btn btn-primary" type="submit">Login</button>-->
                  <input type="submit" class ="btn btn-primary" value="Login"/>
                  {if (isset($err2) && $err2 == "signInError")}
                    <script>
                        $(function() {
                           alert("Login failed, email or password do not match. Please try again");
                        });
                    </script>
                  {/if}
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
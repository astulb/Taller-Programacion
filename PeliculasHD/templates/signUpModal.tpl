<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="doSignUp.php" method="POST">
              <div class="input-group form-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><img src="img/icons/person.svg" alt="uIcon"></span>
                  </div>
                  <input name="alias" type="text" class="form-control" placeholder="Username">
              </div>
              <div class="input-group form-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><img src="img/icons/envelope.svg" alt="eIcon"></span>
                  </div>
                  <input name="email" type="email" class="form-control" placeholder="Email">
              </div>
              <div class="input-group form-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><img src="img/icons/shield-lock.svg" alt="pIcon"></span>
                  </div>
                  <input name="password" type="password" class="form-control" placeholder="Password">
              </div>  
              
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <input type="submit" value="Register" class="btn btn-primary"/>
                  {if (isset($err1) && $err1 == "signUpErrorEmptyFields")}
                    <script>
                        $(function() {
                           alert("Error in registration, there were empty fields. Please try again");
                        });
                    </script>
                  {elseif (isset($err1) && $err1 == "signUpErrorExistentUser")}
                    <script>
                        $(function() {
                           alert("Error in registration, email or alias has already been taken. Please try again");
                        });
                    </script>
                  {/if}
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
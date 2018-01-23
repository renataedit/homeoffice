<section class="new-user">
  <div class="container">
    <h2 class="post-title">Új személy felvétele</h2>
    <form class="new-user" action="" method="post" data-toggle="validator">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label for="username">Felhasználónév</label>
            <input type="text" class="form-control" required="true" name="username" value="" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label for="pass1">Jelszó</label>
            <input type="password" class="form-control" required="true" name="pass1" id="pass1"  data-minlength="8" value="" />
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label for="pass2">Jelszó újra</label>
            <input type="password" class="form-control" required="true" name="pass2" id="pass2" data-minlength="8" data-match="#pass1" value="" />
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label for="last_name">Vezetéknév</label>
            <input type="text" class="form-control" required="true" name="last_name" value="" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label for="first_name">Keresztnév</label>
            <input type="text" class="form-control" required="true" name="first_name" value="" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label for="select-role">Jogkör</label>
            <select class="form-control" id="select-role" name="role" required="true">
              <option value="" selected disabled>---</option>
              <option value="admin">Admin</option>
              <option value="user">Felhasználó</option>
            </select>
          </div>
        </div>
      </div>
      <button type="submit" name="submitNewUser" class="btn btn-primary">Mentés</button>
      <div class="message">

      </div>
    </form>
  </div>
</section>

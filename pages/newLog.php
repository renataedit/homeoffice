  <section class="save-new-log">
    <div class="container">
      <h2 class="post-title">Új log</h2>
      <form class="new-log" action="" method="post">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <select class="form-control" id="select-person" name="userid">
                <option value="" selected disabled>Válassz egy embert...</option>
                <?php
                  $users = getUsers();
                  foreach( $users as $user ){
                    echo '<option value="' . $user['id'] . '"> ' . $user['first_name'] . ' ' . $user['last_name'] . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <select class="form-control" id="select-person" name="log_type">
                <option value="" selected disabled>Távollét típusa</option>
                <option value="home_office">Home office</option>
                <option value="during_the_day">Napközbeni távollét</option>
                <option value="leaves_early">Korábban távozik</option>
                <option value="comes_late">Később érkezik</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-3">
              <div class="input-group date date-from">
                <input type="text" class="form-control" name="date_from" data-date-format="yyyy-mm-dd"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <input id="datetime_from" type="tel" name="datetime_from" placeholder="MM:YY" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?" class="masked form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-3">
              <div class="input-group date date-to">
                <input type="text" class="form-control" name="date_to" data-date-format="yyyy-mm-dd"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <input id="datetime_to" type="tel" name="datetime_to" placeholder="MM:YY" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?" class="masked form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <label for="comment">Távollét oka:</label>
              <textarea class="form-control" rows="5" name="reason" id="comment"></textarea>
            </div>
          </div>
        </div>
        <button type="submit" name="submitNewLog" class="btn btn-primary">Mentés</button>
      </form>
      <div class="response"></div>
    </div>
  </section>

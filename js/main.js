jQuery.noConflict();

jQuery.fn.datepicker.defaults.format = "yyyy-mm-dd";

function getConfirmation()
{
   var retVal = confirm("Biztos, hogy törölni akarod?");
   if( retVal == true )
   {
      return true;
   }
   else
   {
      return false;
   }
}

function deleteLog(logid)
{
  if( getConfirmation() == true )
  {
    jQuery.post('ajax.php', {
      action: 'deleteLog',
      logid: logid,
    }, function(){
      jQuery('.table--logs').find("[data-logid='" + logid + "']").remove();
    });
  }
}

function deleteUser(userid)
{
  if( getConfirmation() == true )
  {
    jQuery.post('ajax.php', {
      action: 'deleteUser',
      userid: userid,
    }, function(){
      jQuery('.table--users').find("[data-userid='" + userid + "']").remove();
    });
  }
}

jQuery(document).ready( function(){
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();

  var minusOneYearFromNow = d.getFullYear()-1 + '-' +
      (month<10 ? '0' : '') + month + '-' +
      (day<10 ? '0' : '') + day;

  // var pastDatesDisabled = [];

  jQuery('.input-group.date').datepicker({
      weekStart: 1,
      autoclose: true,
      datesDisabled: [],
      startDate: minusOneYearFromNow,
  });

  jQuery('#show-logs-select-person').on('change', function(e) {
    var userid = jQuery(this).find(":selected").val();
    jQuery.post( 'ajax.php', {
        action: 'getUserLog',
        userid: userid,
    }, function(data){
      jQuery('.table--logs table tbody tr').remove();
      jQuery('.table--logs table tbody').html(data);
    });
  });

  jQuery(".tablesorter").tablesorter();


  // Logs list: show or hide full text

  jQuery(".fulltext .glyphicon-plus").click(function(){
    jQuery(this).closest('.smalltext').hide();
    jQuery(this).closest('.fulltext').find('.longtext').show();
  });

  jQuery(".fulltext .glyphicon-minus").click(function(){
    jQuery(this).closest('.longtext').toggle();
    jQuery(this).closest('.fulltext').find('.smalltext').show();
  });

  // 

});

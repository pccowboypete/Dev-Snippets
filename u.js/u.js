var inprogress_exclude = 0;
var inreview_exclude = 0;
var pending_exclude = 0;
var available_exclude = 0;

var reduce = false;
reduce = true;
reduce = false;

var pesoToUSD = 57.8;

const formatterUSD = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',

  trailingZeroDisplay: 'stripIfInteger'
});

const formatterPHP = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'PHP',

  trailingZeroDisplay: 'stripIfInteger'
});

$(document).ready(function () {

  // in progress
  if (true) {

    var inprogress_dollarVal = $(".js-tab-in_progress .qa-reports-amount").text().replace("$", "");
    inprogress_dollarVal = inprogress_dollarVal - inprogress_exclude;
    var inprogress_vat = ((inprogress_dollarVal * .10) * .12);

    inprogress_dollarVal = reduce ? inprogress_dollarVal * .6 : (inprogress_dollarVal * .9) - inprogress_vat;
    
    var inprogress_pesoVal = (inprogress_dollarVal - 2) * pesoToUSD;

    inprogress_vat = formatterPHP.format(inprogress_vat * pesoToUSD);
    inprogress_dollarVal = formatterUSD.format(inprogress_dollarVal);
    inprogress_pesoVal = formatterPHP.format(inprogress_pesoVal);

    $(".js-tab-in_progress .qa-reports-amount").html(inprogress_dollarVal + "<br>" + inprogress_pesoVal + "<br>VAT : " + inprogress_vat);

  }


  // in review
  if (true) {

    var inreview_dollarVal = $(".js-tab-in_review .qa-reports-amount").text().replace("$", "");
    inreview_dollarVal = inreview_dollarVal - inreview_exclude;
    var inreview_vat = ((inreview_dollarVal * .10) * .12);

    inreview_dollarVal = reduce ? inreview_dollarVal * .6 : (inreview_dollarVal * .9) - inreview_vat;

    var inreview_pesoVal;

    if (inreview_dollarVal != 0) {
      inreview_pesoVal = (inreview_dollarVal - 2) * pesoToUSD;
    }

    if (!isNaN(inreview_pesoVal)) {
      inreview_vat = formatterPHP.format(inreview_vat * pesoToUSD);
      inreview_dollarVal = formatterUSD.format(inreview_dollarVal);
      inreview_pesoVal = formatterPHP.format(inreview_pesoVal);
      $(".js-tab-in_review .qa-reports-amount").html(inreview_dollarVal + "<br>" + inreview_pesoVal + "<br>VAT : " + inreview_vat);
    }else{
      $(".js-tab-in_review .qa-reports-amount").html("$0.00<br>₱0.00<br>VAT : ₱0.00");
    }

  }


  // pending
  if (true) {

    var pending_dollarVal = $(".js-tab-pending .qa-reports-amount").text().replace("$", "");
    pending_dollarVal = pending_dollarVal - pending_exclude;
    var pending_vat = ((pending_dollarVal * .10) * .12);

    pending_dollarVal = reduce ? pending_dollarVal * .6 : pending_dollarVal - pending_vat;
    //pending_dollarVal = reduce ? pending_dollarVal * .75 : pending_dollarVal * .9;

    var pending_pesoVal;


    if (pending_dollarVal != 0) {
      pending_pesoVal = (pending_dollarVal - 2) * pesoToUSD;
    }

    if (!isNaN(pending_pesoVal)) {
      pending_vat = formatterPHP.format(pending_vat * pesoToUSD);
      pending_dollarVal = formatterUSD.format(pending_dollarVal);
      pending_pesoVal = formatterPHP.format(pending_pesoVal);
      $(".js-tab-pending .qa-reports-amount").html(pending_dollarVal + "<br>" + pending_pesoVal + "<br>VAT : " + pending_vat);
    } else {
      $(".js-tab-pending .qa-reports-amount").html("$0.00<br>₱0.00<br>VAT : ₱0.00");
    }

  }


  // available
  if (true) {

    var available_dollarVal = $(".js-tab-available .qa-reports-amount").text().replace("$", "");
    available_dollarVal = available_dollarVal - available_exclude;
    var available_vat = ((available_dollarVal * .10) * .12);

    available_dollarVal = reduce ? available_dollarVal * .6 : available_dollarVal - available_vat;
    //available_dollarVal = reduce ? available_dollarVal * .75 : available_dollarVal * .9;

    var available_pesoVal;


    if (available_dollarVal != 0) {
      available_pesoVal = (available_dollarVal - 2) * pesoToUSD;
    }

    if (!isNaN(available_pesoVal)) {
      available_vat = formatterPHP.format(available_vat * pesoToUSD);
      available_dollarVal = formatterUSD.format(available_dollarVal);
      available_pesoVal = formatterPHP.format(available_pesoVal);
      $(".js-tab-available .qa-reports-amount").html(available_dollarVal + "<br>" + available_pesoVal + "<br>VAT : " + available_vat);
    } else {
      $(".js-tab-available .qa-reports-amount").html("$0.00<br>₱0.00<br>VAT : ₱0.00");
    }

  }


});


if (true) {

  function timeToMinutes(str) {
    if (!str || !str.includes(":")) return 0;
    let [h, m] = str.split(":").map(Number);
    if (isNaN(h) || isNaN(m)) return 0;
    return h * 60 + m;
  }

  function addTime(timeStr, minutesToAdd) {
    timeStr = String(timeStr).trim();

    timeStr = timeStr.replace(/[^0-9:]/g, '');

    if ((timeStr.match(/:/g) || []).length !== 1) {
      return "0:00";
    }

    let [h, m] = timeStr.split(':').map(Number);

    if (isNaN(h) || isNaN(m)) return "0:00";
    if (m < 0 || m > 59) return "0:00";

    let total = h * 60 + m + minutesToAdd;

    let newH = Math.floor(total / 60);
    let newM = total % 60;

    return newH + ':' + newM.toString().padStart(2, '0');
  }

  $(document).ready(function () {

    var qa_reports_timesheet = $(".qa-reports-timesheet");
    var qa_reports_timesheet_th = qa_reports_timesheet.find(" > thead > tr > th");
    var _this_tr = qa_reports_timesheet.find(" > tbody > tr");

    // We will sum minutes for columns 1–7
    let columnMinutes = {
      1: 0,
      2: 0,
      3: 0,
      4: 0,
      5: 0,
      6: 0,
      7: 0
    };

    _this_tr.each(function (index_tr, tr) {
      var _this_td = $(tr).find(" > td");

      if (index_tr <= 9) {
        _this_td.each(function (index_td, td) {

          if (index_td >= 1 && index_td <= 7) {

            //if (index_td == 2) {

            $(td).find(".sr-only").remove();

            let raw = $(td).text().trim().replace(/[^0-9:]/g, '');
            let mins = timeToMinutes(raw);

            columnMinutes[index_td] += mins;
          }

        });
      }


    });

    // After ALL rows processed, print totals to TH
    for (let col = 1; col <= 7; col++) {

      let totalHMM = addTime("0:00", columnMinutes[col]);

      $(qa_reports_timesheet_th[col]).append("<br>" + totalHMM);
    }

  });

}





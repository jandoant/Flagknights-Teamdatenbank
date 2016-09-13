//Sortierfunktion
  var table = $("#tabelle_personen").stupidtable();
  table.on("aftertablesort", function (event, data) {
        var th = $(this).find("th");
        th.find(".arrow").remove();
        var dir = $.fn.stupidtable.dir;

        var arrow = data.direction === dir.ASC ? "&#8679;" : "&#8681;";
        th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
      });
  //Clickable-Row
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

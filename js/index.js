$( document ).ready(function() {
      $("#kereses").live('click', function () {
      $( "#main" ).load( "./table.php", function() {
         $("#adattar").live('click', function () {
                  $("#main").load("./about.html", function() {
    
});
                });
          console.log("hej");
               var                table = $('#example').DataTable({
                    "bProcessing": true,
                    "bServerSide": true,
					bAutoWidth: false , 
"oLanguage": {
	"sSearch": "Keresés: ",
"oPaginate": {
"sFirst": "Első oldal", // This is the link to the first page
"sPrevious": "Előző oldal", // This is the link to the previous page
"sNext": "Következő oldal", // This is the link to the next page
"sLast": "Utolsó oldal" // This is the link to the last page
}
},
                    "columnDefs": [
				 {
							"sWidth": "6%",
                            "targets": [0]
                        },
						 {
							"sWidth": "8%",
                            "targets": [1]
                        },
						{
							"sWidth": "8%",
                            "targets": [2]
                        },
						{
							"sWidth": "10%",
                            "targets": [3]
                        },
						{
							"sWidth": "12%",
                            "targets": [4]
                        },
						{
							"sWidth": "23%",
                            "targets": [5]
                        },
						{
							"sWidth": "8%",
                            "targets": [6]
                        },
						{
							"sWidth": "8%",
                            "targets": [7]
                        },
						{
							"sWidth": "8%",
                            "targets": [8]
                        },
						{
							"sWidth": "8%",
                            "targets": [9]
                        },
						
                        {
                            "targets": [10],
                            "visible": false,
                        },
                        {
                            "targets": [11],
                            "visible": false
                        },
                        {
                            "targets": [12],
                            "visible": false
                        },
                        {
                            "targets": [13],
                            "visible": false
                        },
                        {
                            "targets": [14],
                            "visible": false
                        },
                        {
                            "targets": [15],
                            "visible": false
                        }
                    ],
					"bAutoWidth": false,
					    "bLengthChange": false,
		
				
                    "bSort": false,
                    "sAjaxSource": "./Nice.php",
                });



                $('#cucc th').each(function () {
                    var title = $(this).text();
					console.log(title);
					if (title=="Adat"){
						$(this).html('<div style="width: 100px; margin-left:-20px"><input style="border: 1px solid white;background-color : #7195BC; " size=100px id="' + title + '" type="text" placeholder=" Keresés..." /></div>');
					}
					else {
                    $(this).html('<div><input style="border: 1px solid white;background-color : #7195BC; "  id="' + title + '" type="text" placeholder=" Keresés..." /></div>');
					}
                });
                table.columns().every(function () {
                    var that = this;
					//nsole.log( $('input', this.header()));
                    $('input', this.header()).on('keyup change', function () {
						//console.log(this.header());
						if (this.value!=""){
							this.style.backgroundColor = "white";
							this.style.color="black";
							this.style.border="1px solid grey";
						}
						else {
							this.style.backgroundColor = "#7195BC";
							this.style.border="2px solid white";
						}
                        if (that.search() !== this.value) {
                            that
                                    .search(this.value)
                                    .draw();
                        }
                    });
                });


         
  $("#removeInputValues").live('click', function () {
                    var i = 0;
                    $("#example :input").each(function () {
                        $(this).val("");
                        i++;
                        if (i == 10) {
                            return false;
                        }
                    });
                    table.columns().search("").draw();
                });
                $('#export').live('click', function () {
                    var i = 0;
                    var k = 0;
                    var urlParams = "?";
                    $("#example :input").each(function () {
                        i++;
                        k = i - 1;
                        if (i == 11) {
                            return false;
                        }
                        urlParams = urlParams + "sSearch_" + k + "=" + $(this).val() + "&";
                    });
                    urlParams = urlParams + "sSearch_10=&sSearch_11&sSearch_12=&sSearch_13=&sSearch_14=&sSearch_15";
                    console.log(urlParams);
                    window.open("Export.php" + urlParams + "", "_self");

                });
                $('#startMap').live('click', function () {
                    destroy();
                    var i = 0;
                    var k = 0;
                    var urlParams = "?";
                    $("#example :input").each(function () {
                        i++;
                        k = i - 1;
                        if (i == 11) {
                            return false;
                        }
                        urlParams = urlParams + "sSearch_" + k + "=" + $(this).val() + "&";
                    });
                    urlParams = urlParams + "sSearch_10=&sSearch_11&sSearch_12=&sSearch_13=&sSearch_14=&sSearch_15";
                    $.ajax({
                        dataType: "json",
                        type: "GET",
                        url: "Map.php" + urlParams,
                        success: function (data) {
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].szelesseg != "") {
                                    addMarker(data[i].szelesseg, data[i].hosszusag, data[i].telepulesSZTA, data[i].adat);
                                }
                            }
                        }
                    });
                });
});});
    $("#fejlec").live('click', function () {
      $( "#main" ).load( "./table.php", function() {
         $("#adattar").live('click', function () {
                  $("#main").load("./about.html", function() {
    
});
                });
          console.log("hej");
               var                table = $('#example').DataTable({
                    "bProcessing": true,
                    "bServerSide": true,
					bAutoWidth: false , 
"oLanguage": {
	"sSearch": "Keresés: ",
"oPaginate": {
"sFirst": "Első oldal", // This is the link to the first page
"sPrevious": "Előző oldal", // This is the link to the previous page
"sNext": "Következő oldal", // This is the link to the next page
"sLast": "Utolsó oldal" // This is the link to the last page
}
},
                    "columnDefs": [
				 {
							"sWidth": "6%",
                            "targets": [0]
                        },
						 {
							"sWidth": "8%",
                            "targets": [1]
                        },
						{
							"sWidth": "8%",
                            "targets": [2]
                        },
						{
							"sWidth": "10%",
                            "targets": [3]
                        },
						{
							"sWidth": "12%",
                            "targets": [4]
                        },
						{
							"sWidth": "23%",
                            "targets": [5]
                        },
						{
							"sWidth": "8%",
                            "targets": [6]
                        },
						{
							"sWidth": "8%",
                            "targets": [7]
                        },
						{
							"sWidth": "8%",
                            "targets": [8]
                        },
						{
							"sWidth": "8%",
                            "targets": [9]
                        },
						
                        {
                            "targets": [10],
                            "visible": false,
                        },
                        {
                            "targets": [11],
                            "visible": false
                        },
                        {
                            "targets": [12],
                            "visible": false
                        },
                        {
                            "targets": [13],
                            "visible": false
                        },
                        {
                            "targets": [14],
                            "visible": false
                        },
                        {
                            "targets": [15],
                            "visible": false
                        }
                    ],
					"bAutoWidth": false,
					    "bLengthChange": false,
		
				
                    "bSort": false,
                    "sAjaxSource": "./Nice.php",
                });



                $('#cucc th').each(function () {
                    var title = $(this).text();
					console.log(title);
					if (title=="Adat"){
						$(this).html('<div style="width: 100px; margin-left:-20px"><input style="border: 1px solid white;background-color : #7195BC; " size=100px id="' + title + '" type="text" placeholder=" Keresés..." /></div>');
					}
					else {
                    $(this).html('<div><input style="border: 1px solid white;background-color : #7195BC; "  id="' + title + '" type="text" placeholder=" Keresés..." /></div>');
					}
                });
                table.columns().every(function () {
                    var that = this;
					//nsole.log( $('input', this.header()));
                    $('input', this.header()).on('keyup change', function () {
						//console.log(this.header());
						if (this.value!=""){
							this.style.backgroundColor = "white";
							this.style.color="black";
							this.style.border="1px solid grey";
						}
						else {
							this.style.backgroundColor = "#7195BC";
							this.style.border="2px solid white";
						}
                        if (that.search() !== this.value) {
                            that
                                    .search(this.value)
                                    .draw();
                        }
                    });
                });


         
  $("#removeInputValues").live('click', function () {
                    var i = 0;
                    $("#example :input").each(function () {
                        $(this).val("");
                        i++;
                        if (i == 10) {
                            return false;
                        }
                    });
                    table.columns().search("").draw();
                });
                $('#export').live('click', function () {
                    var i = 0;
                    var k = 0;
                    var urlParams = "?";
                    $("#example :input").each(function () {
                        i++;
                        k = i - 1;
                        if (i == 11) {
                            return false;
                        }
                        urlParams = urlParams + "sSearch_" + k + "=" + $(this).val() + "&";
                    });
                    urlParams = urlParams + "sSearch_10=&sSearch_11&sSearch_12=&sSearch_13=&sSearch_14=&sSearch_15";
                    console.log(urlParams);
                    window.open("Export.php" + urlParams + "", "_self");

                });
                $('#startMap').live('click', function () {
                    destroy();
                    var i = 0;
                    var k = 0;
                    var urlParams = "?";
                    $("#example :input").each(function () {
                        i++;
                        k = i - 1;
                        if (i == 11) {
                            return false;
                        }
                        urlParams = urlParams + "sSearch_" + k + "=" + $(this).val() + "&";
                    });
                    urlParams = urlParams + "sSearch_10=&sSearch_11&sSearch_12=&sSearch_13=&sSearch_14=&sSearch_15";
                    $.ajax({
                        dataType: "json",
                        type: "GET",
                        url: "Map.php" + urlParams,
                        success: function (data) {
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].szelesseg != "") {
                                    addMarker(data[i].szelesseg, data[i].hosszusag, data[i].telepulesSZTA, data[i].adat);
                                }
                            }
                        }
                    });
                });
});});
   $( "#main" ).load( "./table.php", function() {
         $("#adattar").live('click', function () {
                  $("#main").load("./about.html", function() {
    
});
                });
          console.log("hej");
               var                table = $('#example').DataTable({
                    "bProcessing": true,
                    "bServerSide": true,
					bAutoWidth: false , 
"oLanguage": {
	"sSearch": "Keresés: ",
"oPaginate": {
"sFirst": "Első oldal", // This is the link to the first page
"sPrevious": "Előző oldal", // This is the link to the previous page
"sNext": "Következő oldal", // This is the link to the next page
"sLast": "Utolsó oldal" // This is the link to the last page
}
},
                    "columnDefs": [
				 {
							"sWidth": "6%",
                            "targets": [0]
                        },
						 {
							"sWidth": "8%",
                            "targets": [1]
                        },
						{
							"sWidth": "8%",
                            "targets": [2]
                        },
						{
							"sWidth": "10%",
                            "targets": [3]
                        },
						{
							"sWidth": "12%",
                            "targets": [4]
                        },
						{
							"sWidth": "23%",
                            "targets": [5]
                        },
						{
							"sWidth": "8%",
                            "targets": [6]
                        },
						{
							"sWidth": "8%",
                            "targets": [7]
                        },
						{
							"sWidth": "8%",
                            "targets": [8]
                        },
						{
							"sWidth": "8%",
                            "targets": [9]
                        },
						
                        {
                            "targets": [10],
                            "visible": false,
                        },
                        {
                            "targets": [11],
                            "visible": false
                        },
                        {
                            "targets": [12],
                            "visible": false
                        },
                        {
                            "targets": [13],
                            "visible": false
                        },
                        {
                            "targets": [14],
                            "visible": false
                        },
                        {
                            "targets": [15],
                            "visible": false
                        }
                    ],
					"bAutoWidth": false,
					    "bLengthChange": false,
		
				
                    "bSort": false,
                    "sAjaxSource": "./Nice.php",
                });



                $('#cucc th').each(function () {
                    var title = $(this).text();
					console.log(title);
					if (title=="Adat"){
						$(this).html('<div style="width: 100px; margin-left:-20px"><input style="border: 1px solid white;background-color : #7195BC; " size=100px id="' + title + '" type="text" placeholder=" Keresés..." /></div>');
					}
					else {
                    $(this).html('<div><input style="border: 1px solid white;background-color : #7195BC; "  id="' + title + '" type="text" placeholder=" Keresés..." /></div>');
					}
                });
                table.columns().every(function () {
                    var that = this;
					//nsole.log( $('input', this.header()));
                    $('input', this.header()).on('keyup change', function () {
						//console.log(this.header());
						if (this.value!=""){
							this.style.backgroundColor = "white";
							this.style.color="black";
							this.style.border="1px solid grey";
						}
						else {
							this.style.backgroundColor = "#7195BC";
							this.style.border="2px solid white";
						}
                        if (that.search() !== this.value) {
                            that
                                    .search(this.value)
                                    .draw();
                        }
                    });
                });


         
  $("#removeInputValues").live('click', function () {
                    var i = 0;
                    $("#example :input").each(function () {
                        $(this).val("");
                        i++;
                        if (i == 10) {
                            return false;
                        }
                    });
                    table.columns().search("").draw();
                });
                $('#export').live('click', function () {
                    var i = 0;
                    var k = 0;
                    var urlParams = "?";
                    $("#example :input").each(function () {
                        i++;
                        k = i - 1;
                        if (i == 11) {
                            return false;
                        }
                        urlParams = urlParams + "sSearch_" + k + "=" + $(this).val() + "&";
                    });
                    urlParams = urlParams + "sSearch_10=&sSearch_11&sSearch_12=&sSearch_13=&sSearch_14=&sSearch_15";
                    console.log(urlParams);
                    window.open("Export.php" + urlParams + "", "_self");

                });
                $('#startMap').live('click', function () {
                    destroy();
                    var i = 0;
                    var k = 0;
                    var urlParams = "?";
                    $("#example :input").each(function () {
                        i++;
                        k = i - 1;
                        if (i == 11) {
                            return false;
                        }
                        urlParams = urlParams + "sSearch_" + k + "=" + $(this).val() + "&";
                    });
                    urlParams = urlParams + "sSearch_10=&sSearch_11&sSearch_12=&sSearch_13=&sSearch_14=&sSearch_15";
                    $.ajax({
                        dataType: "json",
                        type: "GET",
                        url: "Map.php" + urlParams,
                        success: function (data) {
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].szelesseg != "") {
                                    addMarker(data[i].szelesseg, data[i].hosszusag, data[i].telepulesSZTA, data[i].adat);
                                }
                            }
                        }
                    });
                });
});
    $("#menu").load("./menu.html", function() {
    
});

});
(function (schedule, $, undefined) {

	var dconfig;
	var durl = "http://#ip#/gpio";

	schedule.OnDocumentReady = function (cfg)
	{
		$(document).ready(function () {
			dconfig = jQuery.parseJSON(cfg);
			$(".btns").html("");

			$.each(dconfig.schedule, function( schedule_index, cfg ) {

				//Request_Handler( durl.replace('#ip#', cfg.gpio),
					//function(device_info){

						$.each(cfg.slots, function( index, value ) {
							$(".btns").append('<input class="i2"  id="btn_" rel="' + index + '" ref="1" type="button" onclick="return device.DoRequest(1);" value="' + ("###") + '" />');
						});
					//});
			//});

			//setInterval(function(){ DoRefreshAll(); }, 3500);
        	});
	}

	function DoRefreshAll()
	{
		$.each(dconfig.device, function( device_index, cfg ) {

			Request_Handler( durl.replace('#ip#', cfg.gpio),
				function(device_info){

					$.each(device_info.gpio, function( index, value ) {
						$("#btn_" + value.pin).attr("ref", value.state == 1 ? 0 : 1).attr("class", value.state == 1 ? "i1" : "i2");
					});
				});
		});
	}

	function Request_Handler(req_url, action_func)
	{
		$.ajax({ 
			type: 'GET',
			url: req_url, 
			dataType: 'json',
			success: function (data) {
				//console.log("ajax success event");
			},
			error : function(request, status, error) {

					if( status != "error")
					{
						var data = request.responseText.replace('gpio', '"gpio"').replace('}]}', '"}]}').replace(/pin:/g, '"pin":"').replace(/, state:/g, '", "state":"').replace(/},/g, '"},');
						action_func(jQuery.parseJSON(data));
					}else{
						console.log("null response!");
					}
			}
		});
	}

	schedule.DoRequest = function (pin)
	{
		var state = $("#btn_" + pin).attr("ref");
		var device_index = $("#btn_" + pin).attr("rel");

		Request_Handler( durl.replace('#ip#', dconfig.device[device_index].gpio) + "?pin=" + pin + "&state=" + state, 
			function(device_info){

				$.each(device_info.gpio, function( index, value ) {
					$("#btn_" + value.pin).attr("ref", state == 1 ? 0 : 1).attr("class", value.state == 1 ? "i1" : "i2");
				});
			});

		return false;
	}
}(window.schedule = window.schedule || {}, jQuery));
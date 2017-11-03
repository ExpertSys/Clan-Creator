$(document).ready(function(){
	var maxNumOfClans = 4;
	
	function refreshList() {
		$('.current-teams').load('./teams.php');
		
	}
	var refreshId = setInterval(refreshList, 1000);
	
	$("#sendNew").submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "index.php",
			data: $(this).serialize(),
			success: function(data) {
				$('#teamTitle').val('');
				var totalClans = ($('.team').length);
				
				if (totalClans === maxNumOfClans){
					alert("Max number of clans(" + maxNumOfClans + ") created.");
				}
			},
			error: function() {
			}
		});
	});
	
	$(document).on('click', '.join', function(){
		var getID = $(this).attr("id");
		$.post('./teams.php', { id: getID }, function(data) {
		});
	});
	$(document).on('click', '.leaveTeam', function(){
		var team = $(this).attr("id");
		$.post('./teams.php', { leaveteam: team }, function(data) {
		});
		
	});
	
	function validate(){
		$(".check").hide();
		var newName = $('#guestName');
		
		$(newName).on('keyup',function(){
			if ($(this).val().length >= 3){
				$(".check").css("top", "-2px");
				$(".check").show().fadeIn(200);
				$(".check").animate({
					fontSize: "14px"
				}, 200);
				
			} else if ($(this).val().length < 3){
				$(".check").fadeOut(200);
			}
		});
		
		$("#registerField").submit(function(e){
			var newName = $('#guestName');
			$.post('./teams.php', { user_page: newName.val() }, function(data) {
				$('.current-teams').load('./teams.php');
			});
			$(".validateUser").hide();
		});
	}
	validate();
});

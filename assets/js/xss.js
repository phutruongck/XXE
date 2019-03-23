$('#login').on('submit', function() {
	var data = $(this).serializeArray();
	$.ajax({
		url: baseURL + '/process/login/',
		type: 'POST',
		data: data,
		dataType: "json",
		beforeSend: function() {
			swal({
				text: 'Đang đăng nhập...',
				onOpen: () => {
					swal.showLoading()
				}
			})
		},
		success: function(response) {
			if (response.success) {
 				swal({
  					position: 'center',
  					title: response.success,
  					showConfirmButton: !1,
  					timer: 1000,
  					type: "success"
 				}).then(function() {
 					window.location.href = baseURL
 				})
			}
			else {
   			swal({
    				title: response.error,
    				type: "error"
   			})
		  }
 	  }
  })
})

$('#register').on('submit', function() {
  var data = $(this).serializeArray();
  $.ajax({
    url: baseURL + '/process/register/',
    type: 'POST',
    data: data,
    dataType: "json",
    beforeSend: function() {
      swal({
        text: 'Đang đăng ký...',
        onOpen: () => {
          swal.showLoading()
        }
      })
    },
    success: function(response) {
      if (response.success) {
        swal({
            position: 'center',
            title: response.success,
            showConfirmButton: !1,
            timer: 1000,
            type: "success"
        }).then(function() {
          window.location.href = baseURL
        })
      }
      else {
        swal({
            title: response.error,
            type: "error"
        })
      }
    }
  })
})
<footer class="main-footer">
 <div class="pull-right d-none d-sm-inline-block">
  <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
   <li class="nav-item">
   </li>
 </ul>
</div>
<div class="row" style="align-items: center;">
  <div class="col-md-auto col-12">
   © <?php echo date('Y') ?> All rights reserved.
 </div>
</div>
</footer>
<aside class="control-sidebar">
 <div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger" data-toggle="control-sidebar"><i class="fa fa-close text-white"></i></span> </div>
 <!-- Create the tabs -->
 <div class="dropdown-divider my-30"></div>
 <div>
  <div class="d-flex align-items-center mb-30">
   <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
     <i class="fa fa-sign-out"></i>
   </div>
   <div class="d-flex flex-column fw-500">
    <a href="{{ url('admin/logout') }}" class="text-dark hover-primary mb-1 fs-16">Logout</a>
  </div>
</div>
</div>
<!-- Tab panes -->
</aside>
<script type="text/javascript">
 document.addEventListener('DOMContentLoaded', function() {
  var mode =  localStorage.getItem('mode');
  if (mode === 'dark') {
   document.body.classList.remove('dark-skin');
   document.body.classList.add('light-skin');
 } else {
   document.body.classList.remove('light-skin');
   document.body.classList.add('dark-skin');
 }
});
</script>
<script>
 function darktolight(abc){
  var mode =  abc;
  if (mode === 'dark') {
   document.body.classList.remove('dark-skin');
   document.body.classList.add('light-skin');
   localStorage.setItem('mode', 'light');
 } else {
   document.body.classList.remove('light-skin');
   document.body.classList.add('dark-skin');
   localStorage.setItem('mode', 'dark');
 }
} 
</script>

<script>
    
        // Function to fetch the unread count
        function fetchUnreadCount() {
            $.ajax({
              url: "{{ route('unread_count') }}",
                method: 'GET',
                success: function(response) {
                    // Update the unread count in the UI
                    $('#unreadCount').text(response.unread_count);
                },
                error: function() {
                    console.error('Unable to fetch unread notifications count.');
                }
            });
        }

        
        // Call the function on page load
        fetchUnreadCount();

        setInterval(fetchUnreadCount, 5000);
    
</script>
<script>
function fetchNotifications() {
    $.ajax({
        url: "{{ route('notifications.get') }}",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var notificationBox = $("#notificationBox");
            notificationBox.empty(); // Clear previous notifications

            // Loop through each notification in the response and append it to the notification box
            data.notifications.forEach(function(notification) {
                var notificationHTML = '<div class="notification">';
                notificationHTML += '<strong>' + notification.heading + '</strong>'
                notificationHTML += '<p>' + notification.message + '</p>';
                notificationHTML += '<p>⌚ : ' + notification.date + '</p>';
                notificationHTML += '<a href="' + notification.lead_id + '">View Details</a>';
                notificationHTML += '</div>';
                notificationBox.append(notificationHTML);
            });
        },
        error: function() {
            console.error('Unable to fetch notifications.');
        }
    });
}



function show_notifications(){
     fetchNotifications();
    $("#notificationBox").toggle();
    //  markNotificationsAsRead();
  };
  
  </script>
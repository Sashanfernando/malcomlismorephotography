<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Manage Enquiries</title>
  <link rel="stylesheet" href="manage-enquiries.css">
  <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@100..900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<header>
  <div class="logo">
    <img src="logo1.jpeg" alt="Logo">
  </div>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li class="dropdown">
        <a href="services.html" class="dropbtn">Services</a>
        <div class="dropdown-content">
          <a href="services.html">Weddings</a>
          <a href="services.html">Portraits</a>
          <a href="services.html">Special Events</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="gallery.html" class="dropbtn">Gallery</a>
        <div class="dropdown-content">
          <a href="gallery.html">Landscape</a>
          <a href="gallery.html">Wildlife</a>
          <a href="gallery.html">Coastal Birds</a>
        </div>
      </li>
      <li><a href="login.html">Sign In</a></li>
    </ul>
  </nav>
</header>

<main class="admin-dashboard">
  <aside class="sidebar">
    <ul>
        <li><a href="admin-dashboard.html">Upload New Images</a></li>
        <li><a href="delete-image.php">Delete Images</a></li>
        <li><a href="manage-enquiries.php">Manage Enquiries</a></li>
        <li><a href="edit-profile.html">Edit Profile</a></li>
        <li><a href="manage-accounts.php">Manage Accounts</a></li>
        <li><a href="manage-testimonials.php">Manage Testimonials</a></li>
      
    </ul>
  </aside>

  <section class="content">
    <h2>All Enquiries</h2>
    <table class="enquiries-table">
      <thead>
      <tr>
        <th>Enquiry ID</th>
        <th>Customer Name</th>
        <th>Customer Tel No</th>
        <th>Required Service</th>
        <th>Service Package</th>
        <th>Customer Email</th>
        <th>Job Date</th>
        <th>Job Time</th>
        <th>Job Location</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "photography_website";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

      
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

      
        $sql = "SELECT * FROM enquiries";
        $result = $conn->query($sql);

      
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['contact_no'] . "</td>
                        <td>" . $row['type_of_job'] . "</td>
                        <td>" . $row['package'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['time'] . "</td>
                        <td>" . $row['location'] . "</td>
                        <td>
                            <form method='post' action='delete_enquiry.php' onsubmit='return confirm(\"Are you sure you want to delete this enquiry?\");'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No enquiries found</td></tr>";
        }

        
        $conn->close();
      ?>
      </tbody>
    </table>
  </section>
</main>

<footer>
    <div class="footer-container">
        <div class="footer-nav">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="https://web.facebook.com/malcolmphotographer" target="_blank"><i class="ri-facebook-fill"></i></a>
                <a href="https://web.facebook.com/messages/t/280340858743797" target="_blank"><i class="ri-messenger-fill"></i></a>
                <a href="https://www.instagram.com/malcolm_photography/e" target="_blank"><i class="ri-instagram-fill"></i></a>
                <a href="https://www.linkedin.com/in/sashan-fernando-b91a71235/" target="_blank"><i class="ri-linkedin-fill"></i></a>
            </div>
        </div>
        <div class="footer-contact">
            <h4>Contact Details</h4>
            <p>Email: <a href="mailto:samithasashan2002@gmail.com">malcolmlismore@gmail.com</a></p>
            <p>Phone: <a href="tel:+94721362773">+44 1234 567890</a></p>
            <p>Address: 123 Photography Lane, North West Coast, Scotland</p>
        </div>
        <div class="footer-contact-form">
            <h4>Contact Us</h4>
            <form id="footer-contact-form">
                <input type="email" name="user_email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Malcolm Lismore Photography. All rights reserved.</p>
        <p>Designed by <a href="https://www.linkedin.com/in/sashan-fernando-b91a71235/" target="_blank">Sashan Fernando</a></p>
    </div>
</footer>
<script src="https://cdn.emailjs.com/dist/email.min.js"></script>
<script>
  (function() {
    emailjs.init("zRUyhECI3G-_bQHRf"); 
  })();

  document.getElementById('footer-contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    emailjs.sendForm('service_yrui98i', 'template_y6xaipk', this)
      .then(function(response) {
        alert('Message sent successfully!');
      }, function(error) {
        alert('Failed to send the message. Please try again.');
      });
  });
</script>
</body>
</html>

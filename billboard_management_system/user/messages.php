<?php
include '../includes/db.php'; // Include database connection
include 'header_user.php'; // Include user header

// Redirect if the user is not logged in or is not an advertiser
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 2) {
    header('Location: ../login.php');
    exit;
}

// Fetch all billboard owners (for sending messages)
$stmt = $pdo->query("SELECT id, name FROM users WHERE user_type_id = 1"); // Only billboard owners
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Add CSS for lighter theme and responsive design -->
<style>
    body {
        background-color: #f0f2f5;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .form-control {
        background-color: #fff;
        color: #333;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        background-color: #fff;
        color: #333;
        border-color: #0d6efd;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0b5ed7;
    }

    .message-container {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 20px;
        background-color: #fff;
    }

    .message {
        max-width: 70%;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        position: relative;
    }

    .message.sender {
        background-color: #0d6efd; /* Blue for sender */
        margin-left: auto; /* Align to the right */
        text-align: right;
        color: #fff;
    }

    .message.receiver {
        background-color: #e9ecef; /* Light gray for receiver */
        margin-right: auto; /* Align to the left */
        text-align: left;
        color: #333;
    }

    .message strong {
        display: block;
        font-size: 0.9em;
        color: inherit;
    }

    .message small {
        font-size: 0.8em;
        color: #666;
    }

    .message p {
        margin: 5px 0 0;
        font-size: 1em;
        color: inherit;
    }

    .loading-spinner {
        text-align: center;
        padding: 10px;
        color: #666;
    }

    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .message-container {
            max-height: 200px;
        }

        .message {
            max-width: 90%;
        }
    }
</style>

<div class="container mt-3">
    <h1 class="text-center mb-4">Messages</h1>

    <!-- Add a dropdown to select the billboard owner -->
    <div class="mb-3">
        <label for="selected_receiver_id" class="form-label">Select Billboard Owner</label>
        <select class="form-select" id="selected_receiver_id" required>
            <?php foreach ($admins as $admin): ?>
                <option value="<?php echo $admin['id']; ?>"><?php echo $admin['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Message List -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Conversation</h5>
            <div class="message-container" id="message-list">
                <div class="loading-spinner">
                    <i class="fas fa-spinner fa-spin"></i> Loading messages...
                </div>
            </div>
        </div>
    </div>

    <!-- Send Message Form -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Send Message</h5>
            <form id="send-message-form">
                <input type="hidden" name="receiver_id" id="form_receiver_id" value="">
                <div class="mb-3">
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to fetch new messages
    function fetchNewMessages() {
        var receiver_id = $('#selected_receiver_id').val();
        $.ajax({
            url: '../includes/fetch_messages.php?receiver_id=' + receiver_id,
            method: 'GET',
            success: function(response) {
                $('#message-list').html(response);
                // Scroll to the bottom of the message container
                $('#message-list').scrollTop($('#message-list')[0].scrollHeight);
            },
            error: function() {
                $('#message-list').html('<div class="text-center text-danger py-3"><i class="fas fa-exclamation-circle"></i> Failed to load messages.</div>');
            }
        });
    }

    // Fetch messages when the selected receiver changes
    $('#selected_receiver_id').change(function() {
        $('#form_receiver_id').val($(this).val()); // Update hidden input
        fetchNewMessages();
    });

    // Fetch messages every 3 seconds
    setInterval(fetchNewMessages, 3000);

    // Fetch messages immediately when the page loads
    $(document).ready(function() {
        $('#form_receiver_id').val($('#selected_receiver_id').val()); // Set initial value
        fetchNewMessages();
    });

    // Handle form submission
    $('#send-message-form').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            url: '../includes/send_message.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#message').val(''); // Clear the message input
                fetchNewMessages(); // Refresh messages
            },
            error: function() {
                alert('Failed to send message. Please try again.');
            }
        });
    });
</script>

<?php
include '../includes/footer.php'; // Include footer
?>
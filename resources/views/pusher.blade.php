<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Subscription Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow">
        <div class="card-header text-center">
            <h3>Subscribe to Notification Types</h3>
        </div>
        <div class="card-body">
            <form id="subscription-form" action="{{route('send.sub')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your Full Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Select Notification Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="type1" name="notification_type" value="2" required>
                        <label class="form-check-label" for="type1">Type 1: General Updates</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="type2" name="notification_type" value="3" required>
                        <label class="form-check-label" for="type2">Type 2: Promotions</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="type3" name="notification_type" value="4" required>
                        <label class="form-check-label" for="type3">Type 3: Important Alerts</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="type4" name="notification_type" value="5" required>
                        <label class="form-check-label" for="type4">Type 4: Event Notifications</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
</script>
</body>
</html>

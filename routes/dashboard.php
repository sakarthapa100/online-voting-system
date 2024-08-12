<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location: ../");
    exit;
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

$status = $_SESSION['userdata']['status'] == 0 
    ? '<span class="status not-voted">Not Voted</span>' 
    : '<span class="status voted">Voted</span>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting Portal | Next Generation</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #ff9a9e;
            --background-color: #f6f9fc;
            --text-color: #333;
            --card-background: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            padding: 60px 0;
            margin-bottom: 50px;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            letter-spacing: 2px;
        }

        .header p {
            font-size: 1.3rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--accent-color), #fad0c4);
            color: var(--text-color);
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .profile {
            background-color: var(--card-background);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 50px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .profile::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(106, 17, 203, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.8s ease;
        }

        .profile:hover::before {
            top: -100%;
            left: -100%;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 40px;
            border: 5px solid var(--secondary-color);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .profile:hover .profile-image {
            transform: scale(1.1) rotate(5deg);
        }

        .profile-info h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .profile-detail {
            background-color: #f7f9fc;
            padding: 25px;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .profile-detail:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateY(-5px);
        }

        .status {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1rem;
            text-transform: uppercase;
            margin-top: 15px;
        }

        .status.voted {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
        }

        .status.not-voted {
            background: linear-gradient(135deg, #fa709a, #fee140);
            color: white;
        }

        .groups {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .group {
            background-color: var(--card-background);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .group::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(106, 17, 203, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.8s ease;
        }

        .group:hover::before {
            top: -100%;
            left: -100%;
        }

        .group:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .group img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 30px;
            border: 5px solid var(--secondary-color);
            transition: all 0.3s ease;
        }

        .group:hover img {
            transform: scale(1.1) rotate(5deg);
        }

        .group h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .vote-count {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 25px;
        }

        .vote-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .vote-btn:not(:disabled) {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .vote-btn:not(:disabled):hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .vote-btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile, .group {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @media (max-width: 768px) {
            .header {
                clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
                padding: 40px 0;
            }

            .header h1 {
                font-size: 2.5rem;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-image {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .action-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }

            .btn {
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>E-Voting Portal</h1>
        <p>Empowering Democracy Through Secure Digital Voting</p>
    </header>

    <div class="container">
        <div class="action-buttons">
            <a href="../"><button class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</button></a>
            <a href="logout.php"><button class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
        </div>
        
        <section class="profile">
            <div class="profile-header">
                <img src="../uploads/<?php echo $userdata['photo']; ?>" alt="User Photo" class="profile-image">
                <div class="profile-info">
                    <h2><?php echo $userdata['name']; ?></h2>
                    <?php echo $status; ?>
                </div>
            </div>
            <div class="profile-details">
                <div class="profile-detail">
                    <i class="fas fa-mobile-alt"></i> <strong>Mobile:</strong> <?php echo $userdata['mobile']; ?>
                </div>
                <div class="profile-detail">
                    <i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> <?php echo $userdata['address']; ?>
                </div>
            </div>
        </section>
        
        <section class="groups">
            <?php if ($groupsdata) : ?>
                <?php foreach ($groupsdata as $group) : ?>
                    <div class="group">
                        <img src="../uploads/<?php echo $group['photo']; ?>" alt="<?php echo $group['name']; ?> Photo">
                        <h3><?php echo $group['name']; ?></h3>
                        <div class="vote-count"><i class="fas fa-poll"></i> Votes: <?php echo $group['votes']; ?></div>
                        <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
                            <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                            <?php if ($userdata['status'] == 0) : ?>
                                <button type="submit" class="vote-btn" name="votebtn"><i class="fas fa-vote-yea"></i> Cast Your Vote</button>
                            <?php else : ?>
                                <button type="button" class="vote-btn" disabled><i class="fas fa-check-circle"></i> Vote Cast</button>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
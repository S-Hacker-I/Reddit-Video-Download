<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--gradient-bg);
            color: var(--text-color);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar-left {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 100%;
            background-color: #ffffff;
            padding: var(--spacing);
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: var(--spacing);
            border-right: 4px solid var(--primary-color);
            box-sizing: border-box;
            z-index: 1;
        }

        .main-content {
            margin-left: 320px;
            padding: var(--spacing);
            background-color: #ffffff;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            width: calc(100% - 320px);
            display: flex;
            flex-direction: column;
            gap: var(--spacing);
            box-sizing: border-box;
        }

        .footer-ads {
            margin-top: auto;
            background-color: var(--primary-color);
            padding: 12px;
            text-align: center;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            color: #ffffff;
        }
    </style>
</head>
<body>
    <aside class="sidebar-left">
        <?php display_ads('sidebar'); ?>
    </aside>

    <main class="main-content">
        <div class="social-media">
            <a href="https://www.facebook.com" target="_blank" title="Facebook"><img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook"></a>
            <a href="https://twitter.com" target="_blank" title="Twitter"><img src="https://img.icons8.com/color/48/000000/twitter.png" alt="Twitter"></a>
            <a href="https://www.instagram.com" target="_blank" title="Instagram"><img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram"></a>
            <a href="https://www.linkedin.com" target="_blank" title="LinkedIn"><img src="https://img.icons8.com/color/48/000000/linkedin.png" alt="LinkedIn"></a>
            <a href="https://www.reddit.com" target="_blank" title="Reddit"><img src="https://img.icons8.com/color/48/000000/reddit.png" alt="Reddit"></a>
        </div>

        <h1>Reddit Video Downloader</h1>
        <form id="download-form">
            <input type="text" id="video-url" placeholder="Enter Reddit Video URL" required>
            <button type="submit">Download</button>
        </form>

        <div id="article-content">
            <?php get_template_part('template-parts/article-content'); ?>
        </div>
    </main>

    <?php get_footer(); ?>
</body>
</html>

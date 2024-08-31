const express = require('express');
const youtubedl = require('youtube-dl-exec');
const path = require('path');
const fs = require('fs');
const sanitizeFilename = require('sanitize-filename'); // Ensure filenames are safe

const app = express();
const PORT = 3000;

app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

app.post('/download', async (req, res) => {
    const videoUrl = req.body.url;

    try {
        console.log(`Starting download for URL: ${videoUrl}`);

        // Step 1: Fetch video metadata to get the title
        const videoInfo = await youtubedl(videoUrl, {
            dumpSingleJson: true,
        });

        // Step 2: Sanitize and construct the filename
        const title = sanitizeFilename(videoInfo.title);
        const tempFileName = 'temp_video.mp4'; // Temporary filename for the download
        const finalFileName = `${title}.mp4`; // Final filename

        // Step 3: Download the video with a temporary filename
        await youtubedl(videoUrl, {
            format: 'bestvideo+bestaudio',
            output: tempFileName, // Use temporary filename
            mergeOutputFormat: 'mp4', // Ensure video and audio are merged into a single file
        });

        // Step 4: Rename the file to the final filename
        const tempFilePath = path.join(__dirname, tempFileName);
        const finalFilePath = path.join(__dirname, finalFileName);

        if (fs.existsSync(tempFilePath)) {
            fs.renameSync(tempFilePath, finalFilePath);
        } else {
            throw new Error('Temporary file does not exist.');
        }

        // Step 5: Serve the renamed file
        res.download(finalFilePath, finalFileName, (err) => {
            if (err) {
                console.error('File download error:', err);
                res.status(500).send('Error sending file');
            } else {
                // Step 6: Delete the file after sending
                fs.unlink(finalFilePath, (unlinkErr) => {
                    if (unlinkErr) {
                        console.error('Error deleting file:', unlinkErr);
                    }
                });
            }
        });
    } catch (error) {
        console.error('Error downloading video:', error);
        res.status(500).send(`Error downloading video: ${error.message}`);
    }
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
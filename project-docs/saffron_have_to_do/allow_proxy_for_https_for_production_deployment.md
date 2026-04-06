Done! I've configured Laravel to trust all proxies and generate HTTPS URLs.

Changes made:

Updated bootstrap/app.php to trust all proxies: $middleware->trustProxies(at: '*');
Cleared config and cache
Restarted PM2
Now try logging in again at: https://saffronsweets.com.bd/login

The insecure connection warning should be gone and login should work properly.

If you still have issues, let me know and I'll check the login form directly.
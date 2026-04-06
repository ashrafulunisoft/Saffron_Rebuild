module.exports = {
  apps: [{
    name: 'saffron',
    script: 'php',
    args: 'artisan serve --host=127.0.0.1 --port=8000',
    cwd: '/home/live_ecommerce/saffron_ecommerce/vms-ucbl',
    interpreter: 'none',
    watch: false,
    autorestart: true,
    max_restarts: 10,
    restart_delay: 1000
  }]
};

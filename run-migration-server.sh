#!/bin/bash

# Script to run migration on the server via SSH
# Make sure to set your FTP credentials as environment variables or replace them

# Set your server credentials (replace with your actual values)
FTP_SERVER="your-server.com"
FTP_USERNAME="your-username"
FTP_PASSWORD="your-password"

echo "Uploading migration script to server..."

# Upload the deployment script to the server
sshpass -p "$FTP_PASSWORD" scp -P 65002 -o StrictHostKeyChecking=no deploy-manual.sh $FTP_USERNAME@$FTP_SERVER:/home/u367101322/domains/jobtrust.space/public_html/

echo "Running migration on server..."

# Run the migration script on the server
sshpass -p "$FTP_PASSWORD" ssh -p 65002 -o StrictHostKeyChecking=no $FTP_USERNAME@$FTP_SERVER "cd /home/u367101322/domains/jobtrust.space/public_html && chmod +x deploy-manual.sh && ./deploy-manual.sh"

echo "Migration completed!"

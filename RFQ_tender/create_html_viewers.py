#!/usr/bin/env python3
"""
Generate HTML files for viewing Mermaid diagrams in browser
"""

import os
from pathlib import Path

# HTML template
HTML_TEMPLATE = '''<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title} - VMS UCBL</title>
    <script type="module">
        import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
        mermaid.initialize({{
            startOnLoad: true,
            theme: 'default',
            securityLevel: 'loose',
        }});
    </script>
    <style>
        body {{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }}
        .diagram-container {{
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 20px 0;
            overflow-x: auto;
        }}
        h1 {{
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }}
        .info {{
            background: #e3f2fd;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #2196F3;
        }}
        .info h3 {{
            margin-top: 0;
        }}
        .download-btn {{
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin: 10px 0;
        }}
        .download-btn:hover {{
            background: #45a049;
        }}
    </style>
</head>
<body>
    <h1>{title}</h1>
    <p><strong>{subtitle}</strong></p>

    <div class="info">
        <h3>💡 How to Save as Image</h3>
        <ol>
            <li>Right-click on the diagram below</li>
            <li>Select "Save as image" or take a screenshot</li>
            <li>Or use your browser's print function (Ctrl+P) to save as PDF</li>
            <li>For best quality, use browser zoom (Ctrl +) to enlarge</li>
        </ol>
        <button class="download-btn" onclick="window.print()">🖨️ Print / Save as PDF</button>
    </div>

    <div class="diagram-container">
        <pre class="mermaid">
{mermaid_code}
        </pre>
    </div>

    <div class="info">
        <h3>📋 Description</h3>
        {description}
        <p><strong>Source File:</strong> {source_file}</p>
    </div>
</body>
</html>
'''

# Diagram metadata
DIAGRAMS = {
    "15_1_system_architecture_overview.mmd": {
        "title": "15.1 System Architecture Overview",
        "subtitle": "Visitor Management System - VMS UCBL",
        "description": """<p>This diagram illustrates the high-level system architecture showing:</p>
        <ul>
            <li><strong>User Roles:</strong> Visitors, Staff (Hosts), and Admins</li>
            <li><strong>Authentication Gate:</strong> Login, registration, 2FA (OTP), and password reset</li>
            <li><strong>Role-Based Access Control:</strong> Three levels - Visitor Staff, Receptionist Staff, and Admin</li>
        </ul>"""
    },
    "15_2_visitor_registration_checkin_flow.mmd": {
        "title": "15.2 Visitor Registration & Check-in Flow",
        "subtitle": "Complete Visitor Journey from Arrival to Departure",
        "description": """<p>This diagram shows the complete visitor management workflow:</p>
        <ul>
            <li><strong>Registration:</strong> Pre-registration online or walk-in registration</li>
            <li><strong>Host Approval:</strong> Manual or auto-approval process</li>
            <li><strong>Verification Methods:</strong> OTP, Face Recognition, RFID, or QR Code</li>
            <li><strong>Check-in Process:</strong> Badge assignment and host notification</li>
            <li><strong>Visit Monitoring:</strong> Real-time tracking with overstay alerts</li>
            <li><strong>Check-out:</strong> Badge return and visit archival</li>
        </ul>"""
    },
    "15_3_admin_management_flow.mmd": {
        "title": "15.3 Admin Management Flow",
        "subtitle": "Administrative Functions and Operations",
        "description": """<p>This diagram illustrates all administrative functions:</p>
        <ul>
            <li><strong>Visitor Management:</strong> Create, view, search, edit, and delete visitors</li>
            <li><strong>Visit Management:</strong> Approve, reject, and monitor visits</li>
            <li><strong>Role Management:</strong> Create, assign, and remove user roles</li>
            <li><strong>Reports:</strong> Statistics, visit reports, and CSV exports</li>
            <li><strong>Live Dashboard:</strong> Real-time monitoring via WebSocket</li>
            <li><strong>Settings:</strong> General, notifications, and security configurations</li>
        </ul>"""
    },
    "15_4_host_approval_flow.mmd": {
        "title": "15.4 Host Approval Flow",
        "subtitle": "Host-side Approval and Visit Monitoring",
        "description": """<p>This diagram shows the host approval workflow:</p>
        <ul>
            <li><strong>Notifications:</strong> New visitor alerts via email/SMS/dashboard</li>
            <li><strong>Approval Decision:</strong> Approve, reject, or request more information</li>
            <li><strong>Visitor Monitoring:</strong> Track visitor arrival and visit progress</li>
            <li><strong>Auto-cancel:</strong> Configurable timeout for pending visits</li>
            <li><strong>Completion:</strong> Visit tracking and optional feedback</li>
        </ul>"""
    },
    "15_5_realtime_notification_flow.mmd": {
        "title": "15.5 Real-time Notification Flow",
        "subtitle": "Multi-channel Notification System Architecture",
        "description": """<p>This diagram illustrates the notification system architecture:</p>
        <ul>
            <li><strong>Event Types:</strong> Registration, approval, check-in, check-out, rejection, overstay</li>
            <li><strong>Notification Channels:</strong> Email, SMS, WebSocket, and Database</li>
            <li><strong>Email System:</strong> Queue-based processing with retry logic (3 attempts)</li>
            <li><strong>SMS System:</strong> Queue-based processing with delivery tracking</li>
            <li><strong>WebSocket:</strong> Real-time updates via Reverb server and Redis Pub/Sub</li>
            <li><strong>Database:</strong> Audit logging for compliance with Bangladesh Bank guidelines</li>
        </ul>"""
    }
}

def main():
    base_dir = Path("/home/ashraful/Unisoft/UCBL - VMS/vms-ucbl_last/vms-ucbl/RFQ_tender")

    print("Generating HTML files for Mermaid diagrams...")
    print(f"Base directory: {base_dir}")
    print()

    for mmd_file, metadata in DIAGRAMS.items():
        mmd_path = base_dir / mmd_file

        if not mmd_path.exists():
            print(f"⚠️  Skipping {mmd_file} (not found)")
            continue

        # Read mermaid code
        with open(mmd_path, 'r') as f:
            mermaid_code = f.read()

        # Generate HTML
        html_content = HTML_TEMPLATE.format(
            title=metadata["title"],
            subtitle=metadata["subtitle"],
            mermaid_code=mermaid_code,
            description=metadata["description"],
            source_file=mmd_file
        )

        # Write HTML file
        html_file = base_dir / mmd_file.replace('.mmd', '.html')
        with open(html_file, 'w') as f:
            f.write(html_content)

        print(f"✓ Created: {html_file.name}")

    print()
    print("Done! Open the HTML files in your browser to view the diagrams.")
    print()
    print("Generated files:")
    for mmd_file in DIAGRAMS.keys():
        html_file = mmd_file.replace('.mmd', '.html')
        print(f"  - {html_file}")

if __name__ == "__main__":
    main()

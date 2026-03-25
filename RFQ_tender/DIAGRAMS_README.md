# Visitor Management System - Workflow Diagrams

This directory contains the workflow diagrams for the VMS UCBL project.

## Files Included

### Mermaid Source Files (.mmd)
These are the source files for the diagrams that can be edited and re-rendered:

1. **15_1_system_architecture_overview.mmd** - System Architecture Overview
   - Shows user roles, authentication gate, and role-based access control

2. **15_2_visitor_registration_checkin_flow.mmd** - Visitor Registration & Check-in Flow
   - Complete visitor journey from arrival to departure
   - Includes pre-registration, host approval, check-in methods (OTP, Face ID, RFID, QR)
   - Check-out process and archiving

3. **15_3_admin_management_flow.mmd** - Admin Management Flow
   - Admin dashboard functions
   - Visitor management operations
   - Role management
   - Reports and analytics
   - Live dashboard monitoring
   - System settings

4. **15_4_host_approval_flow.mmd** - Host Approval Flow
   - Host notification system
   - Visit approval/rejection process
   - Visit monitoring and tracking

5. **15_5_realtime_notification_flow.mmd** - Real-time Notification Flow
   - Event types and notification channels
   - Email notification system with retry logic
   - SMS notification system with delivery tracking
   - WebSocket real-time updates via Reverb
   - Database audit logging

## How to View/Edit Diagrams

### Option 1: Online Editors (Easiest)
Visit any of these online Mermaid editors and open the .mmd files:
- **Mermaid Live Editor**: https://mermaid.live
- **Mermaid Ink**: https://mermaid.ink

### Option 2: VS Code
1. Install the "Mermaid Preview" extension
2. Open any .mmd file
3. Right-click and select "Mermaid: Open Preview"

### Option 3: Generate Images Locally

#### Step 1: Install Mermaid CLI
```bash
sudo npm install -g @mermaid-js/mermaid-cli
```

#### Step 2: Run the Conversion Script
```bash
cd /home/ashraful/Unisoft/UCBL\ -\ VMS/vms-ucbl_last/vms-ucbl/RFQ_tender
chmod +x generate_diagrams.sh
./generate_diagrams.sh
```

This will create a `diagrams/` folder with PNG and SVG versions of all diagrams.

#### Step 3: Manual Conversion (Alternative)
```bash
# Convert a single diagram
mmdc -i 15_2_visitor_registration_checkin_flow.mmd -o diagram.png

# Convert with high resolution (scale factor 2)
mmdc -i 15_2_visitor_registration_checkin_flow.mmd -o diagram.png -s 2

# Convert to SVG (vector format, better for documents)
mmdc -i 15_2_visitor_registration_checkin_flow.mmd -o diagram.svg
```

## Quick Reference

| Diagram | File Name | Purpose |
|---------|-----------|---------|
| System Architecture | 15_1_system_architecture_overview.mmd | High-level system overview |
| Visitor Flow | 15_2_visitor_registration_checkin_flow.mmd | Complete visitor journey |
| Admin Flow | 15_3_admin_management_flow.mmd | Admin operations and management |
| Host Approval | 15_4_host_approval_flow.mmd | Host-side approval process |
| Notifications | 15_5_realtime_notification_flow.mmd | Real-time notification system |

## Integration with Documentation

These diagrams are referenced in the technical specifications document:
- **Document**: `03_Technical_Specifications.md`
- **Section 15**: VISITOR MANAGEMENT SYSTEM - WORKING FLOW DIAGRAM

## Tips for Editing

1. **Keep it simple**: Mermaid works best with simple, clean diagrams
2. **Test often**: Use mermaid.live to preview changes
3. **Use consistent styling**: The color codes used are:
   - `#e1f5e1` - Light green (success/start)
   - `#e1f0ff` - Light blue (info/dashboard)
   - `#fff4e1` - Light yellow (action/process)
   - `#ffe1e1` - Light red (error/alert)
   - `#e1f5e1` - Light green (active state)

## Troubleshooting

### Mermaid CLI installation fails
```bash
# Clear npm cache and retry
npm cache clean --force
sudo npm install -g @mermaid-js/mermaid-cli
```

### Puppeteer errors
The mermaid-cli uses Puppeteer which may require additional dependencies:
```bash
sudo apt-get install -y libnss3 libatk1.0-0 libatk-bridge2.0-0 libcups2 libdrm2 libxkbcommon0 libxcomposite1 libxdamage1 libxfixes3 libxrandr2 libgbm1 libasound2
```

### Diagrams not rendering
- Check for syntax errors in the .mmd file
- Ensure all node IDs are unique within each diagram
- Verify that arrow connections reference existing nodes

## License

These diagrams are part of the VMS UCBL project documentation.

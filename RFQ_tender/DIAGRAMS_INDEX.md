# VMS UCBL - Workflow Diagrams Package

All diagrams have been successfully extracted and created as separate files in the RFQ_tender folder!

## 📁 Files Created

### 1. Mermaid Source Files (.mmd) - 5 files
These are the editable source files for all diagrams:

| # | File | Size | Description |
|---|------|------|-------------|
| 1 | `15_1_system_architecture_overview.mmd` | 741 bytes | System Architecture Overview |
| 2 | `15_2_visitor_registration_checkin_flow.mmd` | 3.3 KB | Visitor Registration & Check-in Flow |
| 3 | `15_3_admin_management_flow.mmd` | 3.3 KB | Admin Management Flow |
| 4 | `15_4_host_approval_flow.mmd` | 2.1 KB | Host Approval Flow |
| 5 | `15_5_realtime_notification_flow.mmd` | 2.3 KB | Real-time Notification Flow |

### 2. HTML Viewer Files (.html) - 5 files
Ready-to-view HTML files with embedded Mermaid diagrams:

| # | File | Size | Description |
|---|------|------|-------------|
| 1 | `15_1_system_architecture_overview.html` | 3.7 KB | Open in browser to view |
| 2 | `15_2_visitor_registration_checkin_flow.html` | 6.4 KB | Open in browser to view |
| 3 | `15_3_admin_management_flow.html` | 6.4 KB | Open in browser to view |
| 4 | `15_4_host_approval_flow.html` | 5.1 KB | Open in browser to view |
| 5 | `15_5_realtime_notification_flow.html` | 5.5 KB | Open in browser to view |

### 3. Utility Files - 3 files

| File | Size | Purpose |
|------|------|---------|
| `create_html_viewers.py` | 7.9 KB | Python script to regenerate HTML files |
| `generate_diagrams.sh` | 1.7 KB | Bash script to convert to PNG/SVG (requires mermaid-cli) |
| `DIAGRAMS_README.md` | 4.3 KB | Detailed documentation |

## 🚀 Quick Start

### View Diagrams in Browser
Simply open any `.html` file in your web browser:

```bash
cd /home/ashraful/Unisoft/UCBL\ -\ VMS/vms-ucbl_last/vms-ucbl/RFQ_tender

# Open in your default browser
xdg-open 15_1_system_architecture_overview.html
firefox 15_2_visitor_registration_checkin_flow.html
google-chrome 15_3_admin_management_flow.html
```

### Save Diagrams as Images

**Method 1: From HTML (Easiest)**
1. Open the `.html` file in browser
2. Use browser's Print function (Ctrl+P) → Save as PDF
3. Or take a screenshot
4. Or right-click on diagram → Save as image (if supported)

**Method 2: Using Online Tools**
1. Visit https://mermaid.live
2. Open any `.mmd` file
3. Export as PNG/SVG

**Method 3: Install Mermaid CLI**
```bash
# Install mermaid-cli
sudo npm install -g @mermaid-js/mermaid-cli

# Run conversion script
cd /home/ashraful/Unisoft/UCBL\ -\ VMS/vms-ucbl_last/vms-ucbl/RFQ_tender
./generate_diagrams.sh
```

## 📊 Diagram Overview

### 15.1 System Architecture Overview
Shows the high-level system architecture with:
- User roles (Visitors, Staff, Admins)
- Authentication gate (Login, Register, 2FA, Password Reset)
- Role-based access control (3 levels)

**Best for:** System documentation, presentations, architecture discussions

---

### 15.2 Visitor Registration & Check-in Flow
Complete visitor journey including:
- Pre-registration and walk-in registration
- Host approval workflow
- Multiple verification methods (OTP, Face ID, RFID, QR Code)
- Check-in and check-out process
- Visit monitoring and archiving

**Best for:** Training materials, user guides, process documentation

---

### 15.3 Admin Management Flow
All administrative functions:
- Visitor management (CRUD operations)
- Role management
- Reports and analytics
- Live dashboard monitoring
- System settings

**Best for:** Admin training, system documentation

---

### 15.4 Host Approval Flow
Host-side workflow:
- New visitor notifications
- Approval/rejection process
- Visit monitoring
- Auto-cancel timeout

**Best for:** Host training, process documentation

---

### 15.5 Real-time Notification Flow
Notification system architecture:
- Event types (6 different events)
- 4 notification channels (Email, SMS, WebSocket, Database)
- Retry logic and delivery tracking
- WebSocket real-time updates
- Audit logging

**Best for:** Technical documentation, system architecture

## 🔧 Customize Diagrams

### Edit Source Files
1. Open any `.mmd` file in a text editor
2. Make your changes
3. Regenerate HTML: `python3 create_html_viewers.py`
4. Or view directly in https://mermaid.live

### Color Scheme
The diagrams use a consistent color scheme:
- **Green** (`#e1f5e1`): Success, start, active states
- **Blue** (`#e1f0ff`): Information, dashboards
- **Yellow** (`#fff4e1`): Actions, processes
- **Red** (`#ffe1e1`): Errors, alerts, rejected states

## 📝 File Naming Convention

Files follow this naming pattern:
- `15_X_<diagram_name>.mmd` - Mermaid source
- `15_X_<diagram_name>.html` - HTML viewer

Where `X` is the section number (1-5) matching the technical specification document.

## 🔗 Related Documentation

- **Technical Specifications**: `03_Technical_Specifications.md`
  - Section 15: VISITOR MANAGEMENT SYSTEM - WORKING FLOW DIAGRAM
- **Main Document**: `03_Technical_Specifications.md`

## 💡 Tips

1. **For Presentations**: Use the HTML files and zoom in browser (Ctrl +)
2. **For Documents**: Use mermaid-cli to generate high-resolution PNG
3. **For Web**: Use SVG format for best quality at any size
4. **For Editing**: Use VS Code with Mermaid Preview extension

## 📞 Support

If you need help:
1. Check `DIAGRAMS_README.md` for detailed documentation
2. Visit https://mermaid.js.org for Mermaid syntax reference
3. Use https://mermaid.live for online editing and preview

---

**Package Version**: 1.0
**Created**: March 25, 2026
**Project**: VMS UCBL - Visitor Management System

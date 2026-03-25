#!/bin/bash

# Script to convert Mermaid diagrams to PNG/SVG images
# Make sure you have installed: npm install -g @mermaid-js/mermaid-cli

RFQ_DIR="/home/ashraful/Unisoft/UCBL - VMS/vms-ucbl_last/vms-ucbl/RFQ_tender"
OUTPUT_DIR="$RFQ_DIR/diagrams"

# Create output directory
mkdir -p "$OUTPUT_DIR"

# Array of diagram files
declare -a diagrams=(
    "15_1_system_architecture_overview.mmd"
    "15_2_visitor_registration_checkin_flow.mmd"
    "15_3_admin_management_flow.mmd"
    "15_4_host_approval_flow.mmd"
    "15_5_realtime_notification_flow.mmd"
)

echo "Converting Mermaid diagrams to PNG and SVG..."
echo "Output directory: $OUTPUT_DIR"
echo ""

# Check if mmdc is installed
if ! command -v mmdc &> /dev/null; then
    echo "ERROR: mmdc (mermaid-cli) is not installed!"
    echo "Please install it first:"
    echo "  sudo npm install -g @mermaid-js/mermaid-cli"
    echo ""
    echo "Alternatively, use online tools like:"
    echo "  - https://mermaid.live"
    echo "  - https://mermaid.ink"
    exit 1
fi

# Convert each diagram
for diagram in "${diagrams[@]}"; do
    input="$RFQ_DIR/$diagram"
    basename="${diagram%.mmd}"

    echo "Processing: $diagram"

    # Generate PNG
    mmdc -i "$input" -o "$OUTPUT_DIR/${basename}.png" -b transparent -s 2

    # Generate SVG
    mmdc -i "$input" -o "$OUTPUT_DIR/${basename}.svg" -b transparent

    if [ $? -eq 0 ]; then
        echo "  ✓ Created: ${basename}.png"
        echo "  ✓ Created: ${basename}.svg"
    else
        echo "  ✗ Failed to convert $diagram"
    fi
    echo ""
done

echo "Done! Diagrams saved to: $OUTPUT_DIR"
echo ""
echo "Generated files:"
ls -lh "$OUTPUT_DIR"

#!/usr/bin/env bash

# ==================================
# TRENZYCH PANEL
# Utility Functions
# ==================================

pause() {
    read -rp "Press Enter to continue..."
}

header() {
    clear
    echo "========================================="
    echo "        TRENZYCH PANEL INSTALLER"
    echo "               Version 2.0"
    echo "========================================="
}

command_exists() {
    command -v "$1" >/dev/null 2>&1
}

require_command() {
    if ! command_exists "$1"; then
        echo "[ERROR] Missing command: $1"
        exit 1
    fi
}

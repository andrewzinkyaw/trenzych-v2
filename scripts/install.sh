#!/usr/bin/env bash

# ==========================================
# TRENZYCH PANEL INSTALLER
# Version : 2.0 Beta
# Author  : TRENZYCH
# ==========================================

set -e

RED="\033[1;31m"
GREEN="\033[1;32m"
YELLOW="\033[1;33m"
BLUE="\033[1;34m"
CYAN="\033[1;36m"
WHITE="\033[1;37m"
NC="\033[0m"

info() {
    echo -e "${BLUE}[*]${NC} $1"
}

success() {
    echo -e "${GREEN}[✓]${NC} $1"
}

warn() {
    echo -e "${YELLOW}[!]${NC} $1"
}

error() {
    echo -e "${RED}[✗]${NC} $1"
    exit 1
}

clear

echo -e "${CYAN}"
cat << "EOF"
===========================================
        TRENZYCH PANEL INSTALLER
               Version 2.0
===========================================
EOF
echo -e "${NC}"

if [ "$EUID" -ne 0 ]; then
    error "Please run this installer as root."
fi

success "Running as root"

if [ ! -f /etc/os-release ]; then
    error "Cannot detect operating system."
fi

. /etc/os-release

case "$VERSION_ID" in
    "22.04"|"24.04")
        success "Ubuntu $VERSION_ID detected"
        ;;
    *)
        error "Only Ubuntu 22.04 and 24.04 are supported."
        ;;
esac

info "Checking internet connection..."

if ping -c1 1.1.1.1 >/dev/null 2>&1; then
    success "Internet connection OK"
else
    error "No internet connection."
fi

echo
success "Installer Part 1 completed successfully."
echo
echo "Next: Package installation..."

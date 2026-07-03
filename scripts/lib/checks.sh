#!/usr/bin/env bash

# ==================================
# TRENZYCH PANEL
# System Checks
# ==================================

check_root() {
    if [ "$EUID" -ne 0 ]; then
        error "Please run as root."
        exit 1
    fi
    success "Running as root"
}

check_os() {
    source /etc/os-release

    case "$VERSION_ID" in
        "22.04"|"24.04")
            success "Ubuntu $VERSION_ID detected"
            ;;
        *)
            error "Unsupported Ubuntu version: $VERSION_ID"
            exit 1
            ;;
    esac
}

check_internet() {
    info "Checking internet connection..."

    if ping -c1 1.1.1.1 >/dev/null 2>&1; then
        success "Internet connection OK"
    else
        error "No internet connection."
        exit 1
    fi
}

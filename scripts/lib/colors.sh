#!/usr/bin/env bash

# ==================================
# TRENZYCH PANEL
# Colors Library
# ==================================

RED="\033[1;31m"
GREEN="\033[1;32m"
YELLOW="\033[1;33m"
BLUE="\033[1;34m"
CYAN="\033[1;36m"
WHITE="\033[1;37m"
BOLD="\033[1m"
RESET="\033[0m"

info() {
    echo -e "${BLUE}[*]${RESET} $1"
}

success() {
    echo -e "${GREEN}[✓]${RESET} $1"
}

warn() {
    echo -e "${YELLOW}[!]${RESET} $1"
}

error() {
    echo -e "${RED}[✗]${RESET} $1"
}

title() {
    echo
    echo -e "${CYAN}${BOLD}$1${RESET}"
}

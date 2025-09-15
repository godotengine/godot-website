#!/usr/bin/env bash

color() {
	local BLACK="0"
	local RED="1"
	local GREEN="2"
	local YELLOW="3"
	local BLUE="4"
	local PURPLE="5"
	local CYAN="6"
	local WHITE="7"

	local type="$1"
	local color="$2"
	local uppercase_color="${color^^}"

	validate_color() {
		case "$color" in
		black | red | green | yellow | blue | purple | cyan | white) ;;
		?)
			echo_err "Invalid color: \"$color\""
			return 1
			;;
		esac
		return 0
	}

	case "$type" in
	r | reg | regular)
		if validate_color; then
			echo -e "\e[0;3${!uppercase_color}m"
		else
			return 1
		fi
		;;
	b | bold)
		if validate_color; then
			echo -e "\e[1;3${!uppercase_color}m"
		else
			return 1
		fi
		;;
	u | underline)
		if validate_color; then
			echo -e "\e[4;3${!uppercase_color}m"
		else
			return 1
		fi
		;;
	bg | background)
		if validate_color; then
			echo -e "\e[4${!uppercase_color}m"
		else
			return 1
		fi
		;;
	hi | high)
		if validate_color; then
			echo -e "\e[0;9${!uppercase_color}m"
		else
			return 1
		fi
		;;
	hi-b | hi-bold | high-b | high-bold)
		if validate_color; then
			echo -e "\e[1;9${!uppercase_color}m"
		else
			return 1
		fi
		;;
	hi-bg | hi-background | high-bg | high-background)
		if validate_color; then
			echo -e "\e[0;10${!uppercase_color}m"
		else
			return 1
		fi
		;;
	R | reset)
		echo -e "\e[0m"
		;;
	Rfg | reset-foreground)
		echo -e "\e[39m"
		;;
	Rbg | reset-background)
		echo -e "\e[49m"
		;;
	?)
		echo_err "Error: invalid color type: \"$type\""
		return 1
		;;
	esac
}

echo_err() {
	local IFS=" "
	echo "$@" >&2
}
export -f echo_err

test_ffmpeg() {
	local ffmpeg_path="${1:-ffmpeg}"
	if ! command -v "$ffmpeg_path" >/dev/null 2>&1; then
		echo_err "Error: did not find '$ffmpeg_path', ffmpeg is required"
		show_help 1
	fi
}
export -f test_ffmpeg

join_list() {
	local IFS="$1"
	shift
	echo "$*"
}
export -f join_list

parse_int() {
	if [[ "$#" -gt "1" ]]; then
		echo_err "Too many arguments passed to \`${FUNCNAME[0]}\`"
		return 1
	fi
	printf "%d" "$1" 2>/dev/null
}
export -f parse_int

to_lower() {
	local IFS=" "
	local arg=""
	local -a results=()
	for arg in "$@"; do
		results+=("$(echo "$arg" | awk "{print tolower($1)}")")
		shift
	done
	echo "${results[@]}"
}
export -f to_lower

to_upper() {
	local IFS=" "
	local arg=""
	local -a results=()
	for arg in "$@"; do
		results+=("$(echo "$arg" | awk "{print toupper(\$1)}")")
	done
	echo "${results[@]}"
}
export -f to_upper

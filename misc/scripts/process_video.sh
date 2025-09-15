#!/usr/bin/env bash

trap 'exit 1' SIGINT

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" &>/dev/null && pwd)"
source "${SCRIPT_DIR%/}/utils.sh"

GODOT_WEBSITE_VIDEO_FFMPEG="${GODOT_WEBSITE_VIDEO_FFMPEG:-ffmpeg}"
QUALITY="2M"
INPUT=""
OUTPUT=""

show_help() {
	echo "Usage: $(basename "$0") [-q=2M] [-h] input output"
	echo "  -q Quality"
	echo "  -s Scale 'N:N', with -1 if you want to keep aspect ratio"
	echo "  -h Help"
	echo ""
	echo "Environment variables:"
	echo "  GODOT_WEBSITE_VIDEO_FFMPEG      Path to \`ffmpeg\` (detault: 'ffmpeg')"
	returncode="${1:-0}"
	exit "$returncode"
}

parse_args() {
	while getopts 'q:s:h' opt; do
		case "$opt" in
		q)
			QUALITY="$OPTARG"
			;;
		s)
			SCALE="$OPTARG"
			;;
		h)
			show_help
			;;
		?)
			show_help 1
			;;
		esac
	done

	if [ "$#" -eq 0 ]; then
		show_help
	fi

	test_ffmpeg

	INPUT="${*:$OPTIND:1}"
	OUTPUT="${*:$OPTIND+1:1}"

	if [ -z "$INPUT" ]; then
		echo_err "Error: no input given"
		show_help 1
	fi

	if [ -z "$OUTPUT" ]; then
		echo_err "Error: no output given"
		show_help 1
	fi
}

main() {
	parse_args "$@"

	declare -a scale_param=()
	if [ -n "$SCALE" ]; then
		scale_param+=("-vf" "scale=$SCALE")
	fi

	set -ex

	local pass_one_args=(
		"-i" "$INPUT"
		"-c:v" "libvpx-vp9"
		"-b:v" "$QUALITY"
		"-pass" "1"
		"-an"
		"${scale_param[@]}"
		"-f" "null"
		"$OUTPUT"
	)

	pass_two_args=(
		"-i" "$INPUT"
		"-c:v" "libvpx-vp9"
		"-b:v" "$QUALITY"
		"-pass" "2"
		"-c:a" "libopus"
		"${scale_param[@]}"
		"$OUTPUT"
	)

	"$GODOT_WEBSITE_VIDEO_FFMPEG" "${pass_one_args[@]}"
	"$GODOT_WEBSITE_VIDEO_FFMPEG" "${pass_two_args[@]}"

	set +ex
}

main "$@"

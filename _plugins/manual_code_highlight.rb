# frozen_string_literal: true

require 'English'

module Jekyll
  # Definition of the filters.
  module CodeHighlightFilters
    def manual_highlight_code(input)
      new_input = input
      last_code_block_end = 0
      until (code_block = find_next_code_block(new_input, last_code_block_end)).nil?
        unless code_block.valid?
          last_code_block_end = code_block.end
          next
        end

        code_block_begin = ''
        code_block_begin = new_input[0..code_block.begin - 1] || '' if code_block.begin.positive?
        new_input = code_block_begin \
                    + replace_highlights(code_block.contents, block: code_block.block?) \
                    + (new_input[code_block.end..] || '')

        last_code_block_end = 0
      end

      new_input
    end

    private

    CodeBlock = Struct.new(:begin, :end, :delimiter, :data) do
      def valid?
        !(delimiter == '`' && !block?) || (block? && %w[manual manual-highlight].include?(type))
      end

      def block?
        data.include?("\n")
      end

      def contents
        if block?
          new_content = data.delete_prefix("#{type}\n")
          new_content = unindent(new_content)

          # Make sure that it ends with a newline.
          new_content = "#{new_content.delete_suffix("\n")}\n"
          return new_content
        end

        data
      end

      def type
        return '' unless block?

        /^(.+?)\n/ =~ data
        Regexp.last_match(1) || ''
      end

      private

      def unindent(str)
        loop do
          populated_lines_regex = /^.+/
          unindent_regex = /^#{str.scan(/^[^\S\n\r]+/).min}/

          # We hit the maximum.
          break unless str.scan(unindent_regex).length == str.scan(populated_lines_regex).length

          unindented_str = str.gsub(unindent_regex, '')
          str = unindented_str
        end

        str
      end
    end

    def find_next_code_block(input, from, delimiter = '`')
      code_block_start_regex = /(?:#{delimiter})+/
      from_substr_start = input[from..]
      code_block_start_match = code_block_start_regex.match(from_substr_start)
      return nil if code_block_start_match.nil?

      code_block_start_begin = from + code_block_start_match.begin(0)
      code_block_start_end = from + code_block_start_match.end(0)
      code_block_delimiter = code_block_start_match[0]

      code_block_end_regex = /(?<!`)#{code_block_delimiter}(?!`)/
      from_substr_end = input[code_block_start_end..]
      code_block_end_match = code_block_end_regex.match(from_substr_end)
      return nil if code_block_end_match.nil?

      code_block_end_begin = code_block_start_end + code_block_end_match.begin(0)
      code_block_end_end = code_block_start_end + code_block_end_match.end(0)

      code_block_data = input[code_block_start_end..code_block_end_begin - 1]

      CodeBlock.new(begin: code_block_start_begin, end: code_block_end_end, delimiter: code_block_delimiter,
                    data: code_block_data)
    end

    def replace_highlights(input, block: false)
      return input if input.empty?

      highlights_regex = /(?<!\\)@\[(?<content>.*?)\]\((?<type>.+?)\)/
      non_highlights_regex = /(?<non_highlight>.*?)(?:(?<highlight>#{highlights_regex})|$)/

      num_highlights = input.scan(highlights_regex).length
      highlight_only = input.gsub(highlights_regex, '') == ''

      force_spaces_input = input.gsub(non_highlights_regex) do |_match|
        non_highlight = $LAST_MATCH_INFO[:non_highlight]
        highlight = $LAST_MATCH_INFO[:highlight] || ''
        non_highlight.gsub!('<', '&lt;')
        non_highlight.gsub!('>', '&gt;')
        non_highlight + highlight
      end

      highlights_result = force_spaces_input.gsub(highlights_regex) do |_match|
        type = $LAST_MATCH_INFO[:type]
        next '<wbr>' if type == 'wbr'

        classes = []
        classes.push('code-highlight') if num_highlights == 1 && !block
        classes.push(type)
        content = $LAST_MATCH_INFO[:content]
        content.gsub!('<', '&lt;')
        content.gsub!('>', '&gt;')

        "<span class=\"#{classes.join(' ')}\">#{content}</span>"
      end

      if block
        code_tag = "<code class=\"highlight\">#{highlights_result}</code>"
        pre_tag = "<pre class=\"manual\" markdown=0>#{code_tag}</pre>"
        return pre_tag
      end

      return "<span class=\"code-highlight\">#{highlights_result}</span>" unless highlight_only && num_highlights == 1

      highlights_result
    end
  end
end

Liquid::Template.register_filter(Jekyll::CodeHighlightFilters)

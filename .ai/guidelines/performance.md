# Performance & Execution Overrides
- **Priority Override:** These instructions strictly override all verbose or pre-flight scan guidelines below.
- **No Pre-flight Scans:** Do NOT run `composer show`, global `grep -rin`, or read `.ai/rules/index.md` before starting a task unless explicitly asked or encountering a version error.
- **Selective MCP Usage:** Only call `search-docs`, `database-schema`, or `database-query` when the task directly requires unknown DB columns or version-specific Laravel APIs. Skip them for pure PHP/JS logic refactoring.
- **Concise Output:** Be direct and concise. Output code edits/diffs immediately without conversational filler, summaries, or redundant explanations.
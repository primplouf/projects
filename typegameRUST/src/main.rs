#[macro_use]
extern crate crossterm;
extern crate rand;

use crossterm::{
    style::{Print, SetColors, Colors, Color::{Green, Red, Black, Reset}},
    event::{read, Event, KeyCode, KeyEvent, KeyModifiers},
    terminal::{disable_raw_mode, enable_raw_mode, Clear, ClearType},
    cursor,
};
use std::{
    io::{stdout, Stdout},
    process::exit,
    time::Instant,
};
use rand::{thread_rng, Rng};

fn main() {
    let stdout = stdout();
    enable_raw_mode().unwrap();
    main_menu(&stdout);
    disable_raw_mode().unwrap();
}

fn main_menu(mut stdout: &Stdout) {
    loop {
        execute!(stdout, Clear(ClearType::All), cursor::MoveTo(0, 0), cursor::Hide,
            Print("Welcome the Rust typing test !"), cursor::MoveToNextLine(1),
            Print(" -Press enter to start"), cursor::MoveToNextLine(1),
            Print(" -Ctrl+r to print the rules"), cursor::MoveToNextLine(1),
            Print(" -Ctrl+q to quit"),)
            .unwrap();
        
        //key detection
        loop {
           match read().unwrap() {
                Event::Key(KeyEvent {
                               code: KeyCode::Enter,
                               modifiers: KeyModifiers::NONE,
                           }) => {
                    game(stdout);
                    break;
                },
                Event::Key(KeyEvent {
                               code: KeyCode::Char('r'),
                               modifiers: KeyModifiers::CONTROL,
                           }) => {
                    rules(stdout);
                    break;
                           },
                Event::Key(KeyEvent {
                               code: KeyCode::Char('q'),
                               modifiers: KeyModifiers::CONTROL,
                           }) => exit(0),
                _ => (),
            }
        }
    }    
}

fn game(mut stdout: &Stdout){
    let text = ["This is a typing game.", "Rust is an awesome language.", "Steven is not very smart.", "I'm running out of ideas."];
    let mut rng = thread_rng();
    let _rand:usize = rng.gen_range(0..text.len());
    let mut typos = 0;
    let timer = Instant::now();
    let mut event;
    
    execute!(stdout, cursor::MoveTo(0, 0), Clear(ClearType::All), Print(text[_rand])).unwrap();
    
    for (i, char) in text[_rand].chars().enumerate() {
        if char.is_uppercase() { 
            event = Event::Key(KeyEvent { code: KeyCode::Char(char), modifiers: KeyModifiers::SHIFT, })
        } else {
            event = Event::Key(KeyEvent { code: KeyCode::Char(char), modifiers: KeyModifiers::NONE, })
        }

        if read().unwrap() == event {
            execute!(stdout, cursor::MoveTo(i as u16, 0), SetColors(Colors::new(Black, Green)), Print(char),).unwrap();
        }
        else {
            execute!(stdout, cursor::MoveTo(i as u16, 0), SetColors(Colors::new(Black, Red)), Print(char),).unwrap();
            typos += 1;
        }
    }

    execute!(stdout, cursor::MoveTo(0, 0), SetColors(Colors::new(Reset, Reset)), Clear(ClearType::All), cursor::Hide,
                Print(format!("Your time : {:.2}s", timer.elapsed().as_secs_f32())), cursor::MoveToNextLine(1),
                Print(format!("Number of typos : {}", typos)), cursor::MoveToNextLine(1),
                Print(" -Press enter to return to the menu."), cursor::MoveToNextLine(1),
            ).unwrap();
    while read().unwrap() != Event::Key(KeyEvent { code: KeyCode::Enter, modifiers: KeyModifiers::NONE, }) {
        continue;
    }
}

fn rules(mut stdout: &Stdout){
    execute!(stdout, cursor::MoveTo(0, 0), SetColors(Colors::new(Reset, Reset)), Clear(ClearType::All), cursor::Hide,
                Print("Rules :"), cursor::MoveToNextLine(1),
                Print(" -You have to type the sentence written in the command"), cursor::MoveToNextLine(1),
                Print(" -If you make a mistake you can't go back"), cursor::MoveToNextLine(1),
                Print(" -Green means you typed well"), cursor::MoveToNextLine(1),
                Print(" -Red means you made a mistake"), cursor::MoveToNextLine(1),
                Print("Good luck !"), cursor::MoveToNextLine(1),
                Print(" -Press enter to return to the menu."), cursor::MoveToNextLine(1),
            ).unwrap();
    while read().unwrap() != Event::Key(KeyEvent { code: KeyCode::Enter, modifiers: KeyModifiers::NONE, }) {
        continue;
    }
}
